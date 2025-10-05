<?php

namespace App\Http\Controllers;

use App\Models\Insumo;
use App\Models\Proveedor;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Routing\Controller;

class InsumoController extends Controller
{
    public function index(Request $request)
    {
        $query = Insumo::with('proveedores');
        
        // Filtro simple por nombre
        if ($request->filled('buscar')) {
            $query->where('nombre', 'like', '%' . $request->buscar . '%');
        }
        
        // Filtro por estado
        if ($request->filled('estado') && $request->estado !== 'todos') {
            $query->where('estado', $request->estado);
        }
        
        // Filtro por vencimiento (opciones simples)
        if ($request->filled('vencimiento') && $request->vencimiento !== 'todos') {
            $hoy = Carbon::now();
            
            switch ($request->vencimiento) {
                case 'vencidos':
                    $query->where('fecha_vencimiento', '<', $hoy);
                    break;
                case 'por_vencer':
                    $query->whereBetween('fecha_vencimiento', [$hoy, $hoy->copy()->addDays(30)]);
                    break;
                case 'buenos':
                    $query->where('fecha_vencimiento', '>', $hoy->copy()->addDays(30))
                          ->orWhereNull('fecha_vencimiento');
                    break;
            }
        }
        
        // Filtro por stock
        if ($request->filled('stock') && $request->stock !== 'todos') {
            switch ($request->stock) {
                case 'bajo':
                    $query->whereRaw('stock_actual <= stock_minimo');
                    break;
                case 'normal':
                    $query->whereRaw('stock_actual > stock_minimo');
                    break;
                case 'agotado':
                    $query->where('stock_actual', 0);
                    break;
            }
        }
        
        $insumos = $query->orderBy('nombre')->get();
        $proveedores = Proveedor::where('estado', 'Activo')->get();
        
        // Verificar insumos vencidos o próximos a vencer
        $this->checkExpiringProducts($insumos);
        
        // Contar totales para mostrar en los filtros
        $totales = $this->contarTotales();
        
        return view('insumos.index', compact('insumos', 'proveedores', 'totales'));
    }
    
    private function contarTotales()
    {
        $hoy = Carbon::now();
        
        return [
            'todos' => Insumo::count(),
            'disponibles' => Insumo::where('estado', 'Disponible')->count(),
            'agotados' => Insumo::where('estado', 'Agotado')->count(),
            'vencidos' => Insumo::where('estado', 'Vencido')->count(),
            'stock_bajo' => Insumo::whereRaw('stock_actual <= stock_minimo')->count(),
            'por_vencer' => Insumo::whereBetween('fecha_vencimiento', [$hoy, $hoy->copy()->addDays(30)])->count(),
        ];
    }

    public function create()
    {
        $proveedores = Proveedor::where('estado', 'Activo')->get();
        return view('insumos.create', compact('proveedores'));
    }

    public function store(Request $request)
    {
        // Validaciones mejoradas
        $validatedData = $request->validate([
            'nombre' => [
                'required',
                'string',
                'max:255',
                'unique:tbinsumo,nombre',
                'regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s\-\.]+$/' // Solo letras, espacios, guiones y puntos
            ],
            'stock_actual' => [
                'required',
                'integer',
                'min:0',
                'max:999999'
            ],
            'stock_minimo' => [
                'required',
                'integer',
                'min:0',
                'max:999999'
            ],
            'cantidad' => [
                'required',
                'integer',
                'min:1',
                'max:999999'
            ],
            'precio' => [
                'required',
                'numeric',
                'min:0.01',
                'max:999999.99'
            ],
            'unidad_medida' => [
                'required',
                'string',
                'in:kg,gramos,litros,ml,unidades,metros,cm,cajas,bolsas,botellas,latas,paquetes'
            ],
            'fecha_vencimiento' => 'nullable|date|after:today',
            'estado' => 'required|in:Disponible,Agotado,Vencido',
            'proveedores' => 'array',
            'proveedores.*' => 'exists:tbproveedor,proveedor_id'
        ], [
            // Mensajes personalizados mejorados
            'nombre.required' => 'El nombre del insumo es obligatorio',
            'nombre.regex' => 'El nombre solo puede contener letras, espacios, guiones y puntos',
            'nombre.unique' => 'Ya existe un insumo con este nombre',
            'nombre.max' => 'El nombre no puede tener más de 255 caracteres',
            
            'stock_actual.required' => 'El stock actual es obligatorio',
            'stock_actual.integer' => 'El stock actual debe ser un número entero',
            'stock_actual.min' => 'El stock actual no puede ser negativo',
            'stock_actual.max' => 'El stock actual no puede ser mayor a 999,999',
            
            'stock_minimo.required' => 'El stock mínimo es obligatorio',
            'stock_minimo.integer' => 'El stock mínimo debe ser un número entero',
            'stock_minimo.min' => 'El stock mínimo no puede ser negativo',
            'stock_minimo.max' => 'El stock mínimo no puede ser mayor a 999,999',
            
            'cantidad.required' => 'La cantidad es obligatoria',
            'cantidad.integer' => 'La cantidad debe ser un número entero',
            'cantidad.min' => 'La cantidad debe ser al menos 1',
            'cantidad.max' => 'La cantidad no puede ser mayor a 999,999',
            
            'precio.required' => 'El precio es obligatorio',
            'precio.numeric' => 'El precio debe ser un número válido',
            'precio.min' => 'El precio debe ser mayor a 0',
            'precio.max' => 'El precio no puede ser mayor a 999,999.99',
            
            'unidad_medida.required' => 'La unidad de medida es obligatoria',
            'unidad_medida.in' => 'Debe seleccionar una unidad de medida válida',
            
            'fecha_vencimiento.date' => 'La fecha de vencimiento debe ser una fecha válida',
            'fecha_vencimiento.after' => 'La fecha de vencimiento debe ser posterior a hoy',
            
            'estado.required' => 'El estado es obligatorio',
            'estado.in' => 'El estado debe ser: Disponible, Agotado o Vencido',
            
            'proveedores.array' => 'Los proveedores deben ser una lista válida',
            'proveedores.*.exists' => 'Uno o más proveedores seleccionados no existen',
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

        // Validaciones mejoradas (excluyendo el registro actual)
        $validatedData = $request->validate([
            'nombre' => [
                'required',
                'string',
                'max:255',
                'unique:tbinsumo,nombre,' . $id . ',insumo_id',
                'regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s\-\.]+$/'
            ],
            'stock_actual' => [
                'required',
                'integer',
                'min:0',
                'max:999999'
            ],
            'stock_minimo' => [
                'required',
                'integer',
                'min:0',
                'max:999999'
            ],
            'cantidad' => [
                'required',
                'integer',
                'min:1',
                'max:999999'
            ],
            'precio' => [
                'required',
                'numeric',
                'min:0.01',
                'max:999999.99'
            ],
            'unidad_medida' => [
                'required',
                'string',
                'in:kg,gramos,litros,ml,unidades,metros,cm,cajas,bolsas,botellas,latas,paquetes'
            ],
            'fecha_vencimiento' => 'nullable|date|after:today',
            'estado' => 'required|in:Disponible,Agotado,Vencido',
            'proveedores' => 'array',
            'proveedores.*' => 'exists:tbproveedor,proveedor_id'
        ], [
            // Mismos mensajes personalizados que en store()
            'nombre.required' => 'El nombre del insumo es obligatorio',
            'nombre.regex' => 'El nombre solo puede contener letras, espacios, guiones y puntos',
            'nombre.unique' => 'Ya existe otro insumo con este nombre',
            'nombre.max' => 'El nombre no puede tener más de 255 caracteres',
            
            'stock_actual.required' => 'El stock actual es obligatorio',
            'stock_actual.integer' => 'El stock actual debe ser un número entero',
            'stock_actual.min' => 'El stock actual no puede ser negativo',
            'stock_actual.max' => 'El stock actual no puede ser mayor a 999,999',
            
            'stock_minimo.required' => 'El stock mínimo es obligatorio',
            'stock_minimo.integer' => 'El stock mínimo debe ser un número entero',
            'stock_minimo.min' => 'El stock mínimo no puede ser negativo',
            'stock_minimo.max' => 'El stock mínimo no puede ser mayor a 999,999',
            
            'cantidad.required' => 'La cantidad es obligatoria',
            'cantidad.integer' => 'La cantidad debe ser un número entero',
            'cantidad.min' => 'La cantidad debe ser al menos 1',
            'cantidad.max' => 'La cantidad no puede ser mayor a 999,999',
            
            'precio.required' => 'El precio es obligatorio',
            'precio.numeric' => 'El precio debe ser un número válido',
            'precio.min' => 'El precio debe ser mayor a 0',
            'precio.max' => 'El precio no puede ser mayor a 999,999.99',
            
            'unidad_medida.required' => 'La unidad de medida es obligatoria',
            'unidad_medida.in' => 'Debe seleccionar una unidad de medida válida',
            
            'fecha_vencimiento.date' => 'La fecha de vencimiento debe ser una fecha válida',
            'fecha_vencimiento.after' => 'La fecha de vencimiento debe ser posterior a hoy',
            
            'estado.required' => 'El estado es obligatorio',
            'estado.in' => 'El estado debe ser: Disponible, Agotado o Vencido',
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