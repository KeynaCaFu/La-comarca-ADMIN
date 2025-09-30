<?php

namespace App\Http\Controllers;

use App\Models\Insumo;
use App\Models\Proveedor;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class InsumoController extends Controller
{
    public function index()
    {
        $insumos = Insumo::with('proveedores')->get();
        $proveedores = Proveedor::where('estado', 'Activo')->get();
        return view('insumos.index', compact('insumos', 'proveedores'));
    }

    public function create()
    {
        $proveedores = Proveedor::where('estado', 'Activo')->get();
        return view('insumos.create', compact('proveedores'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'stock_actual' => 'required|integer|min:0',
            'stock_minimo' => 'required|integer|min:0',
            'fecha_vencimiento' => 'nullable|date',
            'unidad_medida' => 'required|string|max:50',
            'cantidad' => 'required|integer|min:1',
            'precio' => 'required|numeric|min:0',
            'estado' => 'required|in:Disponible,Agotado,Vencido',
            'proveedores' => 'nullable|array'
        ]);

        $insumo = Insumo::create($request->all());

        // Sincronizar proveedores
        if ($request->has('proveedores')) {
            $insumo->proveedores()->sync($request->proveedores);
        }

        // Respuesta para AJAX o redirección normal
        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Insumo creado exitosamente.',
                'insumo' => $insumo
            ]);
        }

        return redirect()->route('insumos.index')
            ->with('success', 'Insumo creado exitosamente.');
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
        $request->validate([
            'nombre' => 'required|string|max:100',
            'stock_actual' => 'required|integer|min:0',
            'stock_minimo' => 'required|integer|min:0',
            'fecha_vencimiento' => 'nullable|date',
            'unidad_medida' => 'required|string|max:50',
            'cantidad' => 'required|integer|min:1',
            'precio' => 'required|numeric|min:0',
            'estado' => 'required|in:Disponible,Agotado,Vencido',
            'proveedores' => 'nullable|array'
        ]);

        $insumo = Insumo::findOrFail($id);
        $insumo->update($request->all());

        // Sincronizar proveedores
        $insumo->proveedores()->sync($request->proveedores ?? []);

        // Respuesta para AJAX o redirección normal
        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Insumo actualizado exitosamente.',
                'insumo' => $insumo
            ]);
        }

        return redirect()->route('insumos.index')
            ->with('success', 'Insumo actualizado exitosamente.');
    }

    public function destroy($id)
    {
        $insumo = Insumo::findOrFail($id);
        $insumo->proveedores()->detach(); // Eliminar relaciones
        $insumo->delete();

        return redirect()->route('insumos.index')
            ->with('success', 'Insumo eliminado exitosamente.');
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
}