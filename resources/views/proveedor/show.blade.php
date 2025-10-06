@extends('layouts.app')

@section('title', 'Detalles del Proveedor')

@section('content')
<div class="container-fluid">
    <!-- Header responsive -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">
                <h1 class="h3 mb-0"><i class="fas fa-info-circle me-2"></i> Detalles del Proveedor</h1>
                <a href="{{ route('proveedor.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-1"></i>
                    <span class="d-none d-sm-inline">Volver a Proveedores</span>
                    <span class="d-sm-none">Volver</span>
                </a>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-12 col-xl-10">
            <div class="card shadow-sm">
                <div class="card-header">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-2">
                        <div>
                            <h4 class="mb-1">{{ $proveedor->nombre }}</h4>
                            <small class="text-muted">ID: {{ $proveedor->proveedor_id }}</small>
                        </div>
                        <span class="badge bg-{{ $proveedor->estado == 'Activo' ? 'success' : 'secondary' }} fs-6">
                            {{ $proveedor->estado }}
                        </span>
                    </div>
                </div>
                
                <div class="card-body">
                    <div class="row g-4">
                        <!-- Información de Contacto -->
                        <div class="col-12 col-lg-6">
                            <h5 class="border-bottom pb-2 mb-3"><i class="fas fa-address-book me-2"></i>Información de Contacto</h5>
                            
                            <!-- Vista móvil - Cards -->
                            <div class="d-lg-none">
                                <div class="row g-3">
                                    <div class="col-12">
                                        <div class="card bg-light">
                                            <div class="card-body p-3">
                                                <div class="d-flex align-items-center">
                                                    <i class="fas fa-phone text-primary me-3"></i>
                                                    <div>
                                                        <small class="text-muted d-block">Teléfono</small>
                                                        <strong>{{ $proveedor->telefono }}</strong>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="card bg-light">
                                            <div class="card-body p-3">
                                                <div class="d-flex align-items-center">
                                                    <i class="fas fa-envelope text-primary me-3"></i>
                                                    <div>
                                                        <small class="text-muted d-block">Correo</small>
                                                        <strong class="text-break">{{ $proveedor->correo }}</strong>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="card bg-light">
                                            <div class="card-body p-3">
                                                <div class="d-flex align-items-start">
                                                    <i class="fas fa-map-marker-alt text-primary me-3 mt-1"></i>
                                                    <div>
                                                        <small class="text-muted d-block">Dirección</small>
                                                        <strong>{{ $proveedor->direccion }}</strong>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Vista desktop - Tabla -->
                            <div class="d-none d-lg-block">
                                <table class="table table-borderless">
                                    <tr>
                                        <th class="w-25 text-muted"><i class="fas fa-phone me-2"></i>Teléfono:</th>
                                        <td><strong>{{ $proveedor->telefono }}</strong></td>
                                    </tr>
                                    <tr>
                                        <th class="w-25 text-muted"><i class="fas fa-envelope me-2"></i>Correo:</th>
                                        <td><strong class="text-break">{{ $proveedor->correo }}</strong></td>
                                    </tr>
                                    <tr>
                                        <th class="w-25 text-muted"><i class="fas fa-map-marker-alt me-2"></i>Dirección:</th>
                                        <td><strong>{{ $proveedor->direccion }}</strong></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        
                        <!-- Información Comercial -->
                        <div class="col-12 col-lg-6">
                            <h5 class="border-bottom pb-2 mb-3"><i class="fas fa-chart-line me-2"></i>Información Comercial</h5>
                            
                            <!-- Vista móvil - Cards -->
                            <div class="d-lg-none">
                                <div class="row g-3">
                                    <div class="col-12">
                                        <div class="card bg-light">
                                            <div class="card-body p-3">
                                                <div class="d-flex align-items-center">
                                                    <i class="fas fa-dollar-sign text-success me-3"></i>
                                                    <div>
                                                        <small class="text-muted d-block">Total Compras</small>
                                                        <strong class="text-success">₡{{ number_format($proveedor->total_compras, 2) }}</strong>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="card bg-light">
                                            <div class="card-body p-3">
                                                <div class="d-flex align-items-center">
                                                    <i class="fas fa-boxes text-primary me-3"></i>
                                                    <div>
                                                        <small class="text-muted d-block">Insumos Proveídos</small>
                                                        <span class="badge bg-success">{{ $proveedor->insumos->count() }} insumos</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="card bg-light">
                                            <div class="card-body p-3">
                                                <div class="d-flex align-items-center">
                                                    <i class="fas fa-toggle-on text-info me-3"></i>
                                                    <div>
                                                        <small class="text-muted d-block">Estado</small>
                                                        <span class="badge bg-{{ $proveedor->estado == 'Activo' ? 'success' : 'secondary' }}">
                                                            {{ $proveedor->estado }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Vista desktop - Tabla -->
                            <div class="d-none d-lg-block">
                                <table class="table table-borderless">
                                    <tr>
                                        <th class="w-50 text-muted"><i class="fas fa-dollar-sign me-2"></i>Total Compras:</th>
                                        <td><strong class="text-success">₡{{ number_format($proveedor->total_compras, 2) }}</strong></td>
                                    </tr>
                                    <tr>
                                        <th class="w-50 text-muted"><i class="fas fa-boxes me-2"></i>Insumos Proveídos:</th>
                                        <td>
                                            <span class="badge bg-success">{{ $proveedor->insumos->count() }} insumos</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="w-50 text-muted"><i class="fas fa-toggle-on me-2"></i>Estado:</th>
                                        <td>
                                            <span class="badge bg-{{ $proveedor->estado == 'Activo' ? 'success' : 'secondary' }}">
                                                {{ $proveedor->estado }}
                                            </span>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>

                    @if($proveedor->insumos->count() > 0)
                        <!-- Lista de Insumos -->
                        <div class="row mt-4">
                            <div class="col-12">
                                <h5 class="border-bottom pb-2 mb-3"><i class="fas fa-list me-2"></i>Insumos que Provee</h5>
                                
                                <!-- Vista móvil - Cards -->
                                <div class="d-lg-none">
                                    <div class="row g-3">
                                        @foreach($proveedor->insumos as $insumo)
                                        <div class="col-12 col-md-6">
                                            <div class="card bg-light">
                                                <div class="card-body p-3">
                                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                                        <h6 class="mb-0">{{ $insumo->nombre }}</h6>
                                                        <span class="badge bg-{{ $insumo->estado == 'Disponible' ? 'success' : ($insumo->estado == 'Agotado' ? 'danger' : 'secondary') }}">
                                                            {{ $insumo->estado }}
                                                        </span>
                                                    </div>
                                                    <div class="row text-center">
                                                        <div class="col-6">
                                                            <small class="text-muted d-block">Stock</small>
                                                            <span class="badge bg-{{ $insumo->stock_actual > $insumo->stock_minimo ? 'success' : 'warning' }}">
                                                                {{ $insumo->stock_actual }}
                                                            </span>
                                                        </div>
                                                        <div class="col-6">
                                                            <small class="text-muted d-block">Precio</small>
                                                            <strong class="text-success">₡{{ number_format($insumo->precio, 2) }}</strong>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>

                                <!-- Vista desktop - Tabla -->
                                <div class="d-none d-lg-block">
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Nombre</th>
                                                    <th>Stock Actual</th>
                                                    <th>Precio</th>
                                                    <th>Estado</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($proveedor->insumos as $insumo)
                                                <tr>
                                                    <td><strong>{{ $insumo->nombre }}</strong></td>
                                                    <td>
                                                        <span class="badge bg-{{ $insumo->stock_actual > $insumo->stock_minimo ? 'success' : 'warning' }}">
                                                            {{ $insumo->stock_actual }}
                                                        </span>
                                                    </td>
                                                    <td><strong class="text-success">₡{{ number_format($insumo->precio, 2) }}</strong></td>
                                                    <td>
                                                        <span class="badge bg-{{ $insumo->estado == 'Disponible' ? 'success' : ($insumo->estado == 'Agotado' ? 'danger' : 'secondary') }}">
                                                            {{ $insumo->estado }}
                                                        </span>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="alert alert-warning text-center">
                                    <i class="fas fa-exclamation-triangle fa-2x mb-2"></i>
                                    <h6>Sin Insumos Asignados</h6>
                                    <p class="mb-0">Este proveedor no tiene insumos asignados actualmente.</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Acciones -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="d-flex flex-column flex-sm-row gap-2 justify-content-center">
                                <a href="{{ route('proveedor.edit', $proveedor->proveedor_id) }}" class="btn btn-warning">
                                    <i class="fas fa-edit me-1"></i>
                                    <span class="d-none d-sm-inline">Editar Proveedor</span>
                                    <span class="d-sm-none">Editar</span>
                                </a>
                                <a href="{{ route('proveedor.index') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-list me-1"></i>
                                    <span class="d-none d-sm-inline">Volver a la Lista</span>
                                    <span class="d-sm-none">Lista</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection