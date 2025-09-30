@extends('layouts.app')

@section('title', 'Gestión de Insumos')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1><i class="fas fa-boxes"></i> Gestión de Insumos</h1>
    <button type="button" class="btn btn-primary" onclick="openCreateModal()">
        <i class="fas fa-plus"></i> Nuevo Insumo
    </button>
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
                                <button type="button" class="btn btn-info btn-sm" title="Ver" onclick="openShowModal({{ $insumo->insumo_id }})">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button type="button" class="btn btn-warning btn-sm" title="Editar" onclick="openEditModal({{ $insumo->insumo_id }})">
                                    <i class="fas fa-edit"></i>
                                </button>
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
            <button type="button" class="btn btn-primary" onclick="openCreateModal()">
                <i class="fas fa-plus"></i> Crear Primer Insumo
            </button>
        </div>
        @endif
    </div>
</div>

<!-- Modal para Ver Detalles -->
<div id="showModal" class="custom-modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3><i class="fas fa-info-circle"></i> Detalles del Insumo</h3>
            <span class="close" onclick="closeModal('showModal')">&times;</span>
        </div>
        <div class="modal-body" id="showModalContent">
            <!-- El contenido se cargará aquí dinámicamente -->
        </div>
    </div>
</div>

<!-- Modal para Crear -->
<div id="createModal" class="custom-modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3><i class="fas fa-plus"></i> Crear Nuevo Insumo</h3>
            <span class="close" onclick="closeModal('createModal')">&times;</span>
        </div>
        <div class="modal-body">
            <form id="createForm" action="{{ route('insumos.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="create_nombre" class="form-label">Nombre del Insumo *</label>
                            <input type="text" class="form-control" id="create_nombre" name="nombre" required placeholder="Ej: Harina de Trigo">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="create_unidad_medida" class="form-label">Unidad de Medida *</label>
                            <input type="text" class="form-control" id="create_unidad_medida" name="unidad_medida" required placeholder="Ej: kg, litro, unidad">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="create_stock_actual" class="form-label">Stock Actual *</label>
                            <input type="number" class="form-control" id="create_stock_actual" name="stock_actual" required value="0" min="0">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="create_stock_minimo" class="form-label">Stock Mínimo *</label>
                            <input type="number" class="form-control" id="create_stock_minimo" name="stock_minimo" required value="0" min="0">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="create_cantidad" class="form-label">Cantidad *</label>
                            <input type="number" class="form-control" id="create_cantidad" name="cantidad" required value="1" min="1">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="create_precio" class="form-label">Precio *</label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" step="0.01" class="form-control" id="create_precio" name="precio" required min="0" placeholder="0.00">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="create_fecha_vencimiento" class="form-label">Fecha de Vencimiento</label>
                            <input type="date" class="form-control" id="create_fecha_vencimiento" name="fecha_vencimiento">
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="create_estado" class="form-label">Estado *</label>
                    <select class="form-select" id="create_estado" name="estado" required>
                        <option value="Disponible">Disponible</option>
                        <option value="Agotado">Agotado</option>
                        <option value="Vencido">Vencido</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Proveedores</label>
                    <div class="border p-3 rounded" id="createProveedoresList">
                        @foreach($proveedores as $proveedor)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="proveedores[]" value="{{ $proveedor->proveedor_id }}" id="create_proveedor{{ $proveedor->proveedor_id }}">
                            <label class="form-check-label" for="create_proveedor{{ $proveedor->proveedor_id }}">
                                {{ $proveedor->nombre }} - {{ $proveedor->telefono }}
                            </label>
                        </div>
                        @endforeach
                        @if($proveedores->count() == 0)
                        <p class="text-muted">No hay proveedores activos.</p>
                        @endif
                    </div>
                </div>

                <div class="modal-actions">
                    <button type="button" class="btn btn-secondary" onclick="closeModal('createModal')">
                        <i class="fas fa-times"></i> Cancelar
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Guardar Insumo
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal para Editar -->
<div id="editModal" class="custom-modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3><i class="fas fa-edit"></i> Editar Insumo</h3>
            <span class="close" onclick="closeModal('editModal')">&times;</span>
        </div>
        <div class="modal-body" id="editModalContent">
            <!-- El contenido se cargará aquí dinámicamente -->
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="{{ asset('js/insumo-modals.js') }}"></script>
@endpush