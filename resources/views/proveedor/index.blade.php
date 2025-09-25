@extends('layouts.app')

@section('title', 'Gestión de Proveedores')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1><i class="fas fa-truck"></i> Gestión de Proveedores</h1>
    <a href="{{ route('proveedores.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Nuevo Proveedor
    </a>
</div>

<div class="card">
    <div class="card-body">
        @if($proveedores->count() > 0)
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Contacto</th>
                        <th>Total Compras</th>
                        <th>Insumos</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($proveedores as $proveedor)
                    <tr>
                        <td>{{ $proveedor->proveedor_id }}</td>
                        <td>
                            <strong>{{ $proveedor->nombre }}</strong>
                            <br>
                            <small class="text-muted">{{ $proveedor->direccion }}</small>
                        </td>
                        <td>
                            <i class="fas fa-phone"></i> {{ $proveedor->telefono }}<br>
                            <i class="fas fa-envelope"></i> {{ $proveedor->correo }}
                        </td>
                        <td>${{ number_format($proveedor->total_compras, 2) }}</td>
                        <td>
                            @if($proveedor->insumos->count() > 0)
                                <span class="badge bg-success">{{ $proveedor->insumos->count() }} insumos</span>
                            @else
                                <span class="text-muted">Sin insumos</span>
                            @endif
                        </td>
                        <td>
                            <span class="badge bg-{{ $proveedor->estado == 'Activo' ? 'success' : 'secondary' }}">
                                {{ $proveedor->estado }}
                            </span>
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('proveedores.show', $proveedor->proveedor_id) }}" class="btn btn-info btn-sm" title="Ver">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('proveedores.edit', $proveedor->proveedor_id) }}" class="btn btn-warning btn-sm" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('proveedores.destroy', $proveedor->proveedor_id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" title="Eliminar" 
                                        onclick="return confirm('¿Estás seguro de eliminar este proveedor?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="text-center py-5">
            <i class="fas fa-truck fa-3x text-muted mb-3"></i>
            <h4>No hay proveedores registrados</h4>
            <p class="text-muted">Comienza agregando tu primer proveedor.</p>
            <a href="{{ route('proveedores.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Crear Primer Proveedor
            </a>
        </div>
        @endif
    </div>
</div>
@endsection