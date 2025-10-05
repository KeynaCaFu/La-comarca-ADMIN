<?php

namespace App\Http\Controllers;

use App\Models\Insumo;
use App\Models\Proveedor;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Routing\Controller;

class InsumoController extends Controller
{
    public function index()
    {
        $insumos = Insumo::with('proveedores')->get();
        $proveedores = Proveedor::where('estado', 'Activo')->get(); // Agregar esta línea
        
        // Verificar insumos vencidos o próximos a vencer
        $this->checkExpiringProducts($insumos);
        
        return view('insumos.index', compact('insumos', 'proveedores')); // Agregar 'proveedores'
    }

    public function create()
    {
        $proveedores = Proveedor::where('estado', 'Activo')->get();
        return view('insumos.create', compact('proveedores'));
    }

    public function store(Request $request)
    {
        // Validaciones personalizadas
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255|unique:tbinsumo,nombre',
            'stock_actual' => 'required|integer|min:0',
            'stock_minimo' => 'required|integer|min:0',
            'cantidad' => 'required|integer|min:1',
            'precio' => 'required|numeric|min:0.01',
            'unidad_medida' => 'required|string|max:50',
            'fecha_vencimiento' => 'nullable|date|after:today',
            'estado' => 'required|in:Disponible,Agotado,Vencido',
            'proveedores' => 'array',
            'proveedores.*' => 'exists:tbproveedor,proveedor_id'
        ], [
            // Mensajes personalizados
            'nombre.required' => 'El nombre del insumo es obligatorio',
            'nombre.unique' => 'Ya existe un insumo con este nombre',
            'stock_actual.min' => 'El stock actual no puede ser negativo',
            'stock_minimo.min' => 'El stock mínimo no puede ser negativo',
            'precio.min' => 'El precio debe ser mayor a 0',
            'fecha_vencimiento.after' => 'La fecha de vencimiento debe ser posterior a hoy',
            'estado.in' => 'El estado debe ser: Disponible, Agotado o Vencido',
        ]);

        // Validaciones de lógica de negocio
        $this->validateBusinessLogic($validatedData, $request);

        // Crear el insumo
        $insumo = Insumo::create($validatedData);

        // Asociar proveedores
        if ($request->has('proveedores')) {
            $insumo->proveedores()->attach($request->proveedores);
        }

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Insumo creado exitosamente',
                'insumo' => $insumo->load('proveedores')
            ]);
        }

        return redirect()->route('insumos.index')
            ->with('success', 'Insumo creado exitosamente');
    }

    public function show($id)
    {
        $insumo = Insumo::with('proveedores')->findOrFail($id);
        return view('insumos.show', compact('insumo'));
    }

    public function edit($id)
    {
        $insumo = Insumo::with('proveedores')->findOrFail($id);
        $proveedores = Proveedor::where('estado', 'Activo')->get();
        return view('insumos.edit', compact('insumo', 'proveedores'));
    }

    public function update(Request $request, $id)
    {
        $insumo = Insumo::findOrFail($id);

        // Validaciones (excluyendo el registro actual)
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255|unique:tbinsumo,nombre,' . $id . ',insumo_id',
            'stock_actual' => 'required|integer|min:0',
            'stock_minimo' => 'required|integer|min:0',
            'cantidad' => 'required|integer|min:1',
            'precio' => 'required|numeric|min:0.01',
            'unidad_medida' => 'required|string|max:50',
            'fecha_vencimiento' => 'nullable|date|after:today',
            'estado' => 'required|in:Disponible,Agotado,Vencido',
            'proveedores' => 'array',
            'proveedores.*' => 'exists:tbproveedor,proveedor_id'
        ], [
            'nombre.unique' => 'Ya existe otro insumo con este nombre',
            'fecha_vencimiento.after' => 'La fecha de vencimiento debe ser posterior a hoy',
        ]);

        // Validaciones de lógica de negocio
        $this->validateBusinessLogic($validatedData, $request, $insumo);

        // Actualizar
        $insumo->update($validatedData);

        // Sincronizar proveedores
        $insumo->proveedores()->sync($request->proveedores ?? []);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Insumo actualizado exitosamente',
                'insumo' => $insumo->load('proveedores')
            ]);
        }

        return redirect()->route('insumos.index')
            ->with('success', 'Insumo actualizado exitosamente');
    }

    public function destroy($id)
    {
        $insumo = Insumo::findOrFail($id);
        $insumo->proveedores()->detach(); // Desasociar proveedores
        $insumo->delete();

        return redirect()->route('insumos.index')
            ->with('success', 'Insumo eliminado exitosamente');
    }

    // Método para cargar el contenido del modal de detalles
    public function showModal($id)
    {
        $insumo = Insumo::with('proveedores')->findOrFail($id);
        return view('insumos.partials.show-modal', compact('insumo'));
    }

    // Método para cargar el contenido del modal de editar
    public function editModal($id)
    {
        $insumo = Insumo::with('proveedores')->findOrFail($id);
        $proveedores = Proveedor::where('estado', 'Activo')->get();
        return view('insumos.partials.edit-modal', compact('insumo', 'proveedores'));
    }

    /**
     * Validaciones de lógica de negocio
     */
    private function validateBusinessLogic($data, $request, $insumo = null)
    {
        $errors = [];

        // 1. Validar fecha de vencimiento
        if (isset($data['fecha_vencimiento'])) {
            $fechaVencimiento = Carbon::parse($data['fecha_vencimiento']);
            $hoy = Carbon::now();
            $diasRestantes = $hoy->diffInDays($fechaVencimiento, false);

            if ($diasRestantes < 0) {
                $errors[] = 'La fecha de vencimiento no puede ser anterior a hoy';
            } elseif ($diasRestantes <= 7) {
                // Advertencia para productos que vencen pronto
                session()->flash('warning', 'Advertencia: Este producto vence en ' . $diasRestantes . ' días');
            }
        }

        // 2. Validar coherencia entre stock y estado
        if ($data['stock_actual'] == 0 && $data['estado'] == 'Disponible') {
            $errors[] = 'Un insumo sin stock no puede estar disponible';
        }

        if ($data['stock_actual'] > 0 && $data['estado'] == 'Agotado') {
            $errors[] = 'Un insumo con stock no puede estar agotado';
        }

        // 3. Validar stock mínimo vs actual
        if ($data['stock_actual'] < $data['stock_minimo'] && $data['estado'] == 'Disponible') {
            session()->flash('warning', 'Advertencia: El stock actual está por debajo del mínimo recomendado');
        }

        // 4. Validar precio razonable
        if ($data['precio'] > 1000000) {
            session()->flash('warning', 'Advertencia: El precio parece muy alto, verifique que sea correcto');
        }

        // 5. Validar que tenga al menos un proveedor para productos disponibles
        if ($data['estado'] == 'Disponible' && empty($request->proveedores)) {
            session()->flash('warning', 'Recomendación: Asigne al menos un proveedor para este insumo');
        }

        if (!empty($errors)) {
            throw new \Illuminate\Validation\ValidationException(
                validator([], []),
                response()->json(['errors' => $errors], 422)
            );
        }
    }

    /**
     * Verificar productos vencidos o próximos a vencer
     */
    private function checkExpiringProducts($insumos)
    {
        $hoy = Carbon::now();
        $productosVencidos = 0;
        $productosPorVencer = 0;

        foreach ($insumos as $insumo) {
            if ($insumo->fecha_vencimiento) {
                $fechaVencimiento = Carbon::parse($insumo->fecha_vencimiento);
                $diasRestantes = $hoy->diffInDays($fechaVencimiento, false);

                if ($diasRestantes < 0) {
                    $productosVencidos++;
                    
                    // Actualizar automáticamente a vencido
                    if ($insumo->estado != 'Vencido') {
                        $insumo->update(['estado' => 'Vencido']);
                    }
                } elseif ($diasRestantes <= 7) {
                    $productosPorVencer++;
                }
            }
        }

        if ($productosVencidos > 0) {
            session()->flash('error', "Hay {$productosVencidos} producto(s) vencido(s)");
        }

        if ($productosPorVencer > 0) {
            session()->flash('warning', "Hay {$productosPorVencer} producto(s) que vencen en menos de 7 días");
        }
    }
}