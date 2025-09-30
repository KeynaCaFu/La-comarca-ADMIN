@extends('layouts.app')

@section('title', 'Gestión de Proveedores')

@push('styles')
    <link href="{{ asset('css/pages/proveedores.css') }}" rel="stylesheet">
    <link href="{{ asset('css/proveedor-modals.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1><i class="fas fa-truck"></i> Gestión de Proveedores</h1>
    <button type="button" class="btn btn-add" onclick="openCreateProveedorModal()">
        <i class="fas fa-plus"></i> Nuevo Proveedor
    </button>
</div>

<div class="table-container">
    @if($proveedores->count() > 0)
    <div class="table-responsive">
        <table class="table proveedores-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Contacto</th>
                    <th>Total Compras</th>
                    <th>Insumos</th>
                    <th>Estado</th>
                    <th class="accion">Acciones</th>
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
                    <td class="contacto-info">
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
                        @if($proveedor->estado == 'Activo')
                            <span class="estado-activo-badge">{{ $proveedor->estado }}</span>
                        @else
                            <span class="estado-inactivo-badge">{{ $proveedor->estado }}</span>
                        @endif
                    </td>
                    <td class="baction">
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-info btn-sm" title="Ver" onclick="openShowProveedorModal({{ $proveedor->proveedor_id }})">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button type="button" class="btn btn-warning btn-sm" title="Editar" onclick="openEditProveedorModal({{ $proveedor->proveedor_id }})">
                                <i class="fas fa-edit"></i>
                            </button>
                            <form action="{{ route('proveedor.destroy', $proveedor->proveedor_id) }}" method="POST" class="d-inline">
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
        <button type="button" class="btn btn-primary" onclick="openCreateProveedorModal()">
            <i class="fas fa-plus"></i> Crear Primer Proveedor
        </button>
    </div>
    @endif
</div>

<!-- Modal para Ver Detalles de Proveedor -->
<div id="showProveedorModal" class="custom-modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3><i class="fas fa-info-circle"></i> Detalles del Proveedor</h3>
            <span class="close" onclick="closeProveedorModal('showProveedorModal')">&times;</span>
        </div>
        <div class="modal-body" id="showProveedorModalContent">
            <!-- El contenido se cargará aquí dinámicamente -->
        </div>
    </div>
</div>

<!-- Modal para Crear Proveedor -->
<div id="createProveedorModal" class="custom-modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3><i class="fas fa-plus"></i> Crear Nuevo Proveedor</h3>
            <span class="close" onclick="closeProveedorModal('createProveedorModal')">&times;</span>
        </div>
        <div class="modal-body">
            <form id="createProveedorForm" action="{{ route('proveedor.store') }}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label for="create_proveedor_nombre" class="form-label">Nombre del Proveedor *</label>
                    <input type="text" class="form-control" id="create_proveedor_nombre" name="nombre" required placeholder="Ej: Distribuidora Alimentos Frescos">
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="create_proveedor_telefono" class="form-label">Teléfono *</label>
                            <input type="text" class="form-control" id="create_proveedor_telefono" name="telefono" required placeholder="Ej: 3001234567">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="create_proveedor_correo" class="form-label">Correo Electrónico *</label>
                            <input type="email" class="form-control" id="create_proveedor_correo" name="correo" required placeholder="Ej: contacto@proveedor.com">
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="create_proveedor_direccion" class="form-label">Dirección *</label>
                    <textarea class="form-control" id="create_proveedor_direccion" name="direccion" required placeholder="Ej: Calle 123 #45-67, Bogotá"></textarea>
                </div>

                <div class="section-divider"></div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="create_proveedor_total_compras" class="form-label">Total de Compras *</label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" step="0.01" class="form-control" id="create_proveedor_total_compras" name="total_compras" required value="0" min="0">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="create_proveedor_estado" class="form-label">Estado *</label>
                            <select class="form-select" id="create_proveedor_estado" name="estado" required>
                                <option value="Activo">Activo</option>
                                <option value="Inactivo">Inactivo</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="section-divider"></div>
                
                <div class="mb-3">
                    <label class="form-label">Insumos que Provee <span class="info-tooltip" data-tooltip="Seleccione los insumos que este proveedor puede suministrar">ℹ️</span></label>
                    <div class="border p-3 rounded" id="createProveedorInsumosList" style="background-color: white; border-radius: 10px; max-height: 200px; overflow-y: auto;">
                        @foreach($insumos as $insumo)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="insumos[]" value="{{ $insumo->insumo_id }}" id="create_proveedor_insumo{{ $insumo->insumo_id }}">
                            <label class="form-check-label" for="create_proveedor_insumo{{ $insumo->insumo_id }}">
                                <strong>{{ $insumo->nombre }}</strong> - ${{ number_format($insumo->precio, 2) }}
                                <br><small class="text-muted">{{ $insumo->unidad_medida }} | Stock: {{ $insumo->stock_actual }}</small>
                            </label>
                        </div>
                        @endforeach
                        @if($insumos->count() == 0)
                        <div class="text-center p-3">
                            <i class="fas fa-box-open fa-2x text-muted mb-2"></i>
                            <p class="text-muted">No hay insumos disponibles.</p>
                            <small>Puede crear insumos primero y luego asignarlos a este proveedor.</small>
                        </div>
                        @endif
                    </div>
                    <small class="text-muted mt-2 d-block">
                        <i class="fas fa-info-circle"></i> 
                        Puede seleccionar múltiples insumos que este proveedor puede suministrar
                    </small>
                </div>

                <div class="modal-actions">
                    <button type="button" class="btn btn-secondary" onclick="closeProveedorModal('createProveedorModal')">
                        <i class="fas fa-times"></i> Cancelar
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Guardar Proveedor
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal para Editar Proveedor -->
<div id="editProveedorModal" class="custom-modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3><i class="fas fa-edit"></i> Editar Proveedor</h3>
            <span class="close" onclick="closeProveedorModal('editProveedorModal')">&times;</span>
        </div>
        <div class="modal-body" id="editProveedorModalContent">
            <!-- El contenido se cargará aquí dinámicamente -->
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="{{ asset('js/proveedor-modals.js') }}"></script>
@endpush