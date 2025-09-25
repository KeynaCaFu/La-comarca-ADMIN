<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use App\Models\Insumo;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ProveedorController extends Controller
{
    public function index()
    {
        $proveedores = Proveedor::with('insumos')->get();
        return view('proveedor.index', compact('proveedores'));
    }

    public function create()
    {
        $insumos = Insumo::where('estado', 'Disponible')->get();
        return view('proveedor.create', compact('insumos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'telefono' => 'required|string|max:20',
            'correo' => 'required|email',
            'direccion' => 'required|string',
            'total_compras' => 'required|numeric|min:0',
            'estado' => 'required|in:Activo,Inactivo',
            'insumos' => 'nullable|array'
        ]);

        $proveedor = Proveedor::create($request->all());

        // Sincronizar insumos
        if ($request->has('insumos')) {
            $proveedor->insumos()->sync($request->insumos);
        }

        return redirect()->route('proveedores.index')
            ->with('success', 'Proveedor creado exitosamente.');
    }

    public function show($id)
    {
        $proveedor = Proveedor::with('insumos')->findOrFail($id);
        return view('proveedor.show', compact('proveedor'));
    }

    public function edit($id)
    {
        $proveedor = Proveedor::with('insumos')->findOrFail($id);
        $insumos = Insumo::where('estado', 'Disponible')->get();
        return view('proveedor.edit', compact('proveedor', 'insumos'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'telefono' => 'required|string|max:20',
            'correo' => 'required|email',
            'direccion' => 'required|string',
            'total_compras' => 'required|numeric|min:0',
            'estado' => 'required|in:Activo,Inactivo',
            'insumos' => 'nullable|array'
        ]);

        $proveedor = Proveedor::findOrFail($id);
        $proveedor->update($request->all());

        // Sincronizar insumos
        $proveedor->insumos()->sync($request->insumos ?? []);

        return redirect()->route('proveedores.index')
            ->with('success', 'Proveedor actualizado exitosamente.');
    }

    public function destroy($id)
    {
        $proveedor = Proveedor::findOrFail($id);
        $proveedor->insumos()->detach(); // Eliminar relaciones
        $proveedor->delete();

        return redirect()->route('proveedores.index')
            ->with('success', 'Proveedor eliminado exitosamente.');
    }
}