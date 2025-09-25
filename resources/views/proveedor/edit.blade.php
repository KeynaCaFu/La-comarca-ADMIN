@extends('layouts.app')

@section('title', 'Editar Proveedor')

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <h3><i class="fas fa-edit"></i> Editar Proveedor: {{ $proveedor->nombre }}</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('proveedores.update', $proveedor->proveedor_id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre del Proveedor *</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required 
                               value="{{ old('nombre', $proveedor->nombre) }}">
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="telefono" class="form-label">Teléfono *</label>
                                <input type="text" class="form-control" id="telefono" name="telefono" required 
                                       value="{{ old('telefono', $proveedor->telefono) }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="correo" class="form-label">Correo Electrónico *</label>
                                <input type="email" class="form-control" id="correo" name="correo" required 
                                       value="{{ old('correo', $proveedor->correo) }}">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="direccion" class="form-label">Dirección *</label>
                        <textarea class="form-control" id="direccion" name="direccion" required>{{ old('direccion', $proveedor->direccion) }}</textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="total_compras" class="form-label">Total de Compras *</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" step="0.01" class="form-control" id="total_compras" name="total_compras" required 
                                           value="{{ old('total_compras', $proveedor->total_compras) }}" min="0">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="estado" class="form-label">Estado *</label>
                                <select class="form-select" id="estado" name="estado" required>
                                    <option value="Activo" {{ old('estado', $proveedor->estado) == 'Activo' ? 'selected' : '' }}>Activo</option>
                                    <option value="Inactivo" {{ old('estado', $proveedor->estado) == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Insumos que Provee</label>
                        <div class="border p-3 rounded">
                            @foreach($insumos as $insumo)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="insumos[]" 
                                       value="{{ $insumo->insumo_id }}" id="insumo{{ $insumo->insumo_id }}"
                                       {{ in_array($insumo->insumo_id, old('insumos', $proveedor->insumos->pluck('insumo_id')->toArray())) ? 'checked' : '' }}>
                                <label class="form-check-label" for="insumo{{ $insumo->insumo_id }}">
                                    {{ $insumo->nombre }} - ${{ number_format($insumo->precio, 2) }}
                                </label>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('proveedores.index') }}" class="btn btn-secondary me-md-2">
                            <i class="fas fa-arrow-left"></i> Cancelar
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Actualizar Proveedor
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection