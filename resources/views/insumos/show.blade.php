@extends('layouts.app')

@section('title', 'Detalles del Insumo')

@section('content')
<div class="container-fluid">
    <!-- Header responsive -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">
                <h1 class="h3 mb-0"><i class="fas fa-info-circle me-2"></i> Detalles del Insumo</h1>
                <a href="{{ route('insumos.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-1"></i>
                    <span class="d-none d-sm-inline">Volver a Insumos</span>
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
                            <h4 class="mb-1">{{ $insumo->nombre }}</h4>
                            <small class="text-muted">ID: {{ $insumo->insumo_id }}</small>
                        </div>
                        <span class="badge bg-{{ $insumo->estado == 'Disponible' ? 'success' : ($insumo->estado == 'Agotado' ? 'danger' : 'secondary') }} fs-6">
                            {{ $insumo->estado }}
                        </span>
                    </div>
                </div>
                
                <div class="card-body">
                    <div class="row g-4">
                        <!-- Información General -->
                        <div class="col-12 col-lg-6">
                            <h5 class="border-bottom pb-2 mb-3"><i class="fas fa-info me-2"></i>Información General</h5>
                            
                            <!-- Vista móvil - Cards -->
                            <div class="d-lg-none">
                                <div class="row g-3">
                                    <div class="col-12">
                                        <div class="card bg-light">
                                            <div class="card-body p-3">
                                                <div class="d-flex align-items-center">
                                                    <i class="fas fa-balance-scale text-primary me-3"></i>
                                                    <div>
                                                        <small class="text-muted d-block">Unidad de Medida</small>
                                                        <strong>{{ $insumo->unidad_medida }}</strong>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="card bg-light">
                                            <div class="card-body p-3">
                                                <div class="d-flex align-items-center">
                                                    <i class="fas fa-hashtag text-primary me-3"></i>
                                                    <div>
                                                        <small class="text-muted d-block">Cantidad</small>
                                                        <strong>{{ $insumo->cantidad }}</strong>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="card bg-light">
                                            <div class="card-body p-3">
                                                <div class="d-flex align-items-center">
                                                    <i class="fas fa-dollar-sign text-success me-3"></i>
                                                    <div>
                                                        <small class="text-muted d-block">Precio</small>
                                                        <strong class="text-success">₡{{ number_format($insumo->precio, 2) }}</strong>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="card bg-light">
                                            <div class="card-body p-3">
                                                <div class="d-flex align-items-center">
                                                    <i class="fas fa-calendar-alt text-warning me-3"></i>
                                                    <div>
                                                        <small class="text-muted d-block">Fecha Vencimiento</small>
                                                        <strong>{{ $insumo->fecha_vencimiento ? $insumo->fecha_vencimiento->format('d/m/Y') : 'No especificada' }}</strong>
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
                                        <th class="w-50 text-muted"><i class="fas fa-balance-scale me-2"></i>Unidad de Medida:</th>
                                        <td><strong>{{ $insumo->unidad_medida }}</strong></td>
                                    </tr>
                                    <tr>
                                        <th class="w-50 text-muted"><i class="fas fa-hashtag me-2"></i>Cantidad:</th>
                                        <td><strong>{{ $insumo->cantidad }}</strong></td>
                                    </tr>
                                    <tr>
                                        <th class="w-50 text-muted"><i class="fas fa-dollar-sign me-2"></i>Precio:</th>
                                        <td><strong class="text-success">₡{{ number_format($insumo->precio, 2) }}</strong></td>
                                    </tr>
                                    <tr>
                                        <th class="w-50 text-muted"><i class="fas fa-calendar-alt me-2"></i>Fecha Vencimiento:</th>
                                        <td><strong>{{ $insumo->fecha_vencimiento ? $insumo->fecha_vencimiento->format('d/m/Y') : 'No especificada' }}</strong></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        
                        <!-- Información de Inventario -->
                        <div class="col-12 col-lg-6">
                            <h5 class="border-bottom pb-2 mb-3"><i class="fas fa-warehouse me-2"></i>Inventario</h5>
                            
                            <!-- Vista móvil - Cards -->
                            <div class="d-lg-none">
                                <div class="row g-3">
                                    <div class="col-12">
                                        <div class="card bg-light">
                                            <div class="card-body p-3">
                                                <div class="d-flex align-items-center">
                                                    <i class="fas fa-boxes text-info me-3"></i>
                                                    <div>
                                                        <small class="text-muted d-block">Stock Actual</small>
                                                        <span class="badge bg-{{ $insumo->stock_actual > $insumo->stock_minimo ? 'success' : 'warning' }}">
                                                            {{ $insumo->stock_actual }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="card bg-light">
                                            <div class="card-body p-3">
                                                <div class="d-flex align-items-center">
                                                    <i class="fas fa-exclamation-triangle text-warning me-3"></i>
                                                    <div>
                                                        <small class="text-muted d-block">Stock Mínimo</small>
                                                        <strong class="text-warning">{{ $insumo->stock_minimo }}</strong>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="card bg-light">
                                            <div class="card-body p-3">
                                                <div class="d-flex align-items-center">
                                                    <i class="fas fa-chart-line text-success me-3"></i>
                                                    <div>
                                                        <small class="text-muted d-block">Diferencia</small>
                                                        <span class="badge bg-{{ ($insumo->stock_actual - $insumo->stock_minimo) >= 0 ? 'success' : 'danger' }}">
                                                            {{ $insumo->stock_actual - $insumo->stock_minimo }}
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
                                        <th class="w-50 text-muted"><i class="fas fa-boxes me-2"></i>Stock Actual:</th>
                                        <td>
                                            <span class="badge bg-{{ $insumo->stock_actual > $insumo->stock_minimo ? 'success' : 'warning' }}">
                                                {{ $insumo->stock_actual }}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="w-50 text-muted"><i class="fas fa-exclamation-triangle me-2"></i>Stock Mínimo:</th>
                                        <td><strong class="text-warning">{{ $insumo->stock_minimo }}</strong></td>
                                    </tr>
                                    <tr>
                                        <th class="w-50 text-muted"><i class="fas fa-chart-line me-2"></i>Diferencia:</th>
                                        <td>
                                            <span class="badge bg-{{ ($insumo->stock_actual - $insumo->stock_minimo) >= 0 ? 'success' : 'danger' }}">
                                                {{ $insumo->stock_actual - $insumo->stock_minimo }}
                                            </span>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>

                    @if($insumo->proveedores && $insumo->proveedores->count() > 0)
                        <!-- Proveedores -->
                        <div class="row mt-4">
                            <div class="col-12">
                                <h5 class="border-bottom pb-2 mb-3"><i class="fas fa-truck me-2"></i>Proveedores</h5>
                                
                                <!-- Vista móvil - Cards -->
                                <div class="d-lg-none">
                                    <div class="row g-3">
                                        @foreach($insumo->proveedores as $proveedor)
                                        <div class="col-12 col-md-6">
                                            <div class="card bg-light">
                                                <div class="card-body p-3">
                                                    <div class="d-flex justify-content-between align-items-start">
                                                        <div>
                                                            <h6 class="mb-1">{{ $proveedor->nombre }}</h6>
                                                            <small class="text-muted d-block">
                                                                <i class="fas fa-phone me-1"></i>{{ $proveedor->telefono }}
                                                            </small>
                                                            <small class="text-muted">
                                                                <i class="fas fa-envelope me-1"></i>{{ $proveedor->correo }}
                                                            </small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>

                                <!-- Vista desktop - Grid -->
                                <div class="d-none d-lg-block">
                                    <div class="row g-3">
                                        @foreach($insumo->proveedores as $proveedor)
                                        <div class="col-lg-6">
                                            <div class="card">
                                                <div class="card-body py-3">
                                                    <h6 class="card-title mb-2">{{ $proveedor->nombre }}</h6>
                                                    <p class="card-text small mb-0">
                                                        <i class="fas fa-phone text-primary me-2"></i>{{ $proveedor->telefono }}<br>
                                                        <i class="fas fa-envelope text-primary me-2"></i>{{ $proveedor->correo }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="alert alert-warning text-center">
                                    <i class="fas fa-exclamation-triangle fa-2x mb-2"></i>
                                    <h6>Sin Proveedores</h6>
                                    <p class="mb-0">Este insumo no tiene proveedores asignados.</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Status Alert -->
                    @if($insumo->stock_actual <= $insumo->stock_minimo)
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="alert alert-warning text-center">
                                    <i class="fas fa-exclamation-triangle fa-2x mb-2"></i>
                                    <h6>Stock Bajo</h6>
                                    <p class="mb-0">El stock actual está por debajo del mínimo recomendado. Considere reabastecer.</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Acciones -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="d-flex flex-column flex-sm-row gap-2 justify-content-center">
                                <a href="{{ route('insumos.edit', $insumo->insumo_id) }}" class="btn btn-warning">
                                    <i class="fas fa-edit me-1"></i>
                                    <span class="d-none d-sm-inline">Editar Insumo</span>
                                    <span class="d-sm-none">Editar</span>
                                </a>
                                <a href="{{ route('insumos.index') }}" class="btn btn-outline-secondary">
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