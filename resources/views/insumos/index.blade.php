@extends('layouts.app')

@section('title', 'Gestión de Insumos')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1><i class="fas fa-boxes"></i> Gestión de Insumos</h1>
    <a href="{{ route('insumos.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Nuevo Insumo
    </a>
</div>

<div class="card">
    <div class="card-body">
        @if($insumos->count() > 0)
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Stock Actual</th>
                        <th>Stock Mínimo</th>
                        <th>Precio</th>
                        <th>Proveedores</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($insumos as $insumo)
                    <tr>
                        <td>{{ $insumo->insumo_id }}</td>
                        <td>
                            <strong>{{ $insumo->nombre }}</strong>
                            <br>
                            <small class="text-muted">{{ $insumo->unidad_medida }} - Cant: {{ $insumo->cantidad }}</small>
                        </td>
                        <td>
                            <span class="badge bg-{{ $insumo->stock_actual > $insumo->stock_minimo ? 'success' : 'warning' }}">
                                {{ $insumo->stock_actual }}
                            </span>
                        </td>
                        <td>{{ $insumo->stock_minimo }}</td>
                        <td>${{ number_format($insumo->precio, 2) }}</td>
                        <td>
                            @if($insumo->proveedores->count() > 0)
                                @foreach($insumo->proveedores as $proveedor)
                                    <span class="badge bg-info">{{ $proveedor->nombre }}</span>
                                @endforeach
                            @else
                                <span class="text-muted">Sin proveedores</span>
                            @endif
                        </td>
                        <td>
                            <span class="badge bg-{{ $insumo->estado == 'Disponible' ? 'success' : ($insumo->estado == 'Agotado' ? 'danger' : 'secondary') }}">
                                {{ $insumo->estado }}
                            </span>
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('insumos.show', $insumo->insumo_id) }}" class="btn btn-info btn-sm" title="Ver">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('insumos.edit', $insumo->insumo_id) }}" class="btn btn-warning btn-sm" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('insumos.destroy', $insumo->insumo_id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" title="Eliminar" 
                                        onclick="return confirm('¿Estás seguro de eliminar este insumo?')">
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
            <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
            <h4>No hay insumos registrados</h4>
            <p class="text-muted">Comienza agregando tu primer insumo.</p>
            <a href="{{ route('insumos.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Crear Primer Insumo
            </a>
        </div>
        @endif
    </div>
</div>
@endsection