@extends('layouts.app')

@section('title', 'Dashboard - La Comarca Admin')

@section('content')
<!-- Dashboard Content -->
<div class="dashboard-content">
    <!-- Mobile Welcome Header -->
    <div class="d-lg-none mb-4">
        <div class="mobile-welcome-card">
            <h4 class="text-primary mb-2">¡Bienvenido!</h4>
            <p class="text-muted mb-0">Gestiona tu inventario desde aquí</p>
        </div>
    </div>

    <!-- Stats Cards - Responsive Grid -->
    <div class="row g-3 g-md-4 mb-4">
        <div class="col-6 col-lg-3">
            <div class="stat-card">
                <div class="stat-icon bg-primary">
                    <i class="fas fa-boxes"></i>
                </div>
                <div class="stat-info">
                    <h3 id="totalInsumos">0</h3>
                    <p class="d-none d-sm-block">Total Insumos</p>
                    <p class="d-sm-none">Insumos</p>
                </div>
                <div class="stat-trend d-none d-md-block">
                    <i class="fas fa-arrow-up text-success"></i>
                    <span class="text-success">+12%</span>
                </div>
            </div>
        </div>
        
        <div class="col-6 col-lg-3">
            <div class="stat-card">
                <div class="stat-icon bg-success">
                    <i class="fas fa-truck"></i>
                </div>
                <div class="stat-info">
                    <h3 id="totalProveedores">0</h3>
                    <p class="d-none d-sm-block">Total Proveedores</p>
                    <p class="d-sm-none">Proveedores</p>
                </div>
                <div class="stat-trend d-none d-md-block">
                    <i class="fas fa-arrow-up text-success"></i>
                    <span class="text-success">+5%</span>
                </div>
            </div>
        </div>
        
        <div class="col-6 col-lg-3">
            <div class="stat-card">
                <div class="stat-icon bg-warning">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <div class="stat-info">
                    <h3 id="insumosLowStock">0</h3>
                    <p class="d-none d-sm-block">Stock Bajo</p>
                    <p class="d-sm-none">Stock</p>
                </div>
                <div class="stat-trend d-none d-md-block">
                    <i class="fas fa-arrow-down text-warning"></i>
                    <span class="text-warning">-2</span>
                </div>
            </div>
        </div>
        
        <div class="col-6 col-lg-3">
            <div class="stat-card">
                <div class="stat-icon bg-info">
                    <i class="fas fa-dollar-sign"></i>
                </div>
                <div class="stat-info">
                    <h3 id="valorTotal">₡0</h3>
                    <p class="d-none d-sm-block">Valor Total Inventario</p>
                    <p class="d-sm-none">Valor</p>
                </div>
                <div class="stat-trend d-none d-md-block">
                    <i class="fas fa-arrow-up text-success"></i>
                    <span class="text-success">+8%</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions & Recent Activity Row -->
    <div class="row g-3 g-md-4">
        <!-- Quick Actions -->
        <div class="col-12 col-lg-6 mb-4">
            <div class="action-card">
                <div class="card-header">
                    <h5><i class="fas fa-bolt me-2"></i>Acciones Rápidas</h5>
                </div>
                <div class="card-body">
                    <div class="quick-actions-grid">
                        <a href="{{ route('insumos.index') }}" class="action-btn action-btn-primary">
                            <div class="action-icon">
                                <i class="fas fa-plus"></i>
                            </div>
                            <div class="action-text">
                                <span class="action-title">Nuevo Insumo</span>
                                <span class="action-subtitle d-none d-md-block">Agregar producto al inventario</span>
                            </div>
                        </a>
                        
                        <a href="{{ route('proveedor.index') }}" class="action-btn action-btn-success">
                            <div class="action-icon">
                                <i class="fas fa-user-plus"></i>
                            </div>
                            <div class="action-text">
                                <span class="action-title">Nuevo Proveedor</span>
                                <span class="action-subtitle d-none d-md-block">Registrar nuevo proveedor</span>
                            </div>
                        </a>
                        
                        <a href="#" class="action-btn action-btn-info" onclick="showComingSoon()">
                            <div class="action-icon">
                                <i class="fas fa-chart-bar"></i>
                            </div>
                            <div class="action-text">
                                <span class="action-title">Ver Reportes</span>
                                <span class="action-subtitle d-none d-md-block">Estadísticas y análisis</span>
                            </div>
                        </a>
                        
                        <a href="#" class="action-btn action-btn-warning" onclick="showComingSoon()">
                            <div class="action-icon">
                                <i class="fas fa-download"></i>
                            </div>
                            <div class="action-text">
                                <span class="action-title">Exportar Datos</span>
                                <span class="action-subtitle d-none d-md-block">Descargar información</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Recent Activity -->
        <div class="col-12 col-lg-6 mb-4">
            <div class="action-card recent-activity-card">
                <div class="card-header">
                    <h5><i class="fas fa-history me-2"></i>Actividad Reciente</h5>
                </div>
                <div class="card-body">
                    <div class="activity-timeline">
                        <div class="activity-item">
                            <div class="activity-icon bg-success">
                                <i class="fas fa-check"></i>
                            </div>
                            <div class="activity-content">
                                <div class="activity-title">Sistema iniciado correctamente</div>
                                <p class="text-muted mb-1 d-none d-sm-block">Bienvenido a La Comarca Admin</p>
                                <div class="activity-time">Hace un momento</div>
                            </div>
                        </div>
                        
                        <div class="activity-item">
                            <div class="activity-icon bg-info">
                                <i class="fas fa-tachometer-alt"></i>
                            </div>
                            <div class="activity-content">
                                <div class="activity-title">Dashboard cargado</div>
                                <p class="text-muted mb-1 d-none d-sm-block">Estadísticas actualizadas</p>
                                <div class="activity-time">Ahora</div>
                            </div>
                        </div>
                        
                        <div class="activity-item">
                            <div class="activity-icon bg-primary">
                                <i class="fas fa-database"></i>
                            </div>
                            <div class="activity-content">
                                <div class="activity-title">Base de datos conectada</div>
                                <p class="text-muted mb-1 d-none d-sm-block">Conexión establecida con bdsage</p>
                                <div class="activity-time">Hace 1 minuto</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Additional Info Row - Responsive Grid -->
    <div class="row g-3 g-md-4">
        <!-- Low Stock Alert -->
        <div class="col-12 col-md-6 col-lg-4 mb-3 mb-lg-4">
            <div class="alert-card alert-warning">
                <div class="alert-header">
                    <i class="fas fa-exclamation-triangle"></i>
                    <h6>Alerta de Stock Bajo</h6>
                </div>
                <div class="alert-body">
                    <p class="d-none d-sm-block">Hay productos que requieren atención</p>
                    <p class="d-sm-none">Productos necesitan atención</p>
                    <button class="btn btn-warning btn-sm btn-responsive" onclick="checkLowStock()">
                        Ver Productos
                    </button>
                </div>
            </div>
        </div>
        
        <!-- System Status -->
        <div class="col-12 col-md-6 col-lg-4 mb-3 mb-lg-4">
            <div class="alert-card alert-success">
                <div class="alert-header">
                    <i class="fas fa-check-circle"></i>
                    <h6>Estado del Sistema</h6>
                </div>
                <div class="alert-body">
                    <p class="d-none d-sm-block">Todos los servicios funcionando correctamente</p>
                    <p class="d-sm-none">Sistema funcionando</p>
                    <button class="btn btn-success btn-sm btn-responsive" onclick="checkSystemStatus()">
                        Ver Detalles
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Quick Tips -->
        <div class="col-12 col-md-12 col-lg-4 mb-3 mb-lg-4">
            <div class="alert-card alert-info">
                <div class="alert-header">
                    <i class="fas fa-lightbulb"></i>
                    <h6>Consejo del Día</h6>
                </div>
                <div class="alert-body">
                    <p class="d-none d-sm-block">Mantén siempre actualizado el stock mínimo de tus productos</p>
                    <p class="d-sm-none">Actualiza el stock mínimo</p>
                    <button class="btn btn-info btn-sm btn-responsive" onclick="showTips()">
                        Más Consejos
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link href="{{ asset('css/pages/dashboard.css') }}" rel="stylesheet">
<style>
/* Alert Cards */
.alert-card {
    background: white;
    border-radius: var(--border-radius);
    box-shadow: var(--shadow);
    padding: 1.5rem;
    height: 100%;
    transition: var(--transition);
    border-left: 4px solid;
}

.alert-card:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-lg);
}

.alert-warning {
    border-left-color: #f39c12;
}

.alert-success {
    border-left-color: var(--success);
}

.alert-info {
    border-left-color: #17a2b8;
}

.alert-header {
    display: flex;
    align-items: center;
    margin-bottom: 1rem;
}

.alert-header i {
    font-size: 1.5rem;
    margin-right: 0.75rem;
}

.alert-warning .alert-header i {
    color: #f39c12;
}

.alert-success .alert-header i {
    color: var(--success);
}

.alert-info .alert-header i {
    color: #17a2b8;
}

.alert-header h6 {
    margin: 0;
    font-weight: 600;
    color: var(--dark);
}

.alert-body p {
    color: var(--gray);
    margin-bottom: 1rem;
    line-height: 1.4;
}

@media (max-width: 576px) {
    .alert-card {
        padding: 1.25rem;
    }
    
    .alert-header i {
        font-size: 1.25rem;
        margin-right: 0.5rem;
    }
    
    .alert-header h6 {
        font-size: 0.9rem;
    }
    
    .alert-body p {
        font-size: 0.875rem;
        margin-bottom: 0.75rem;
    }
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Load dashboard stats
    loadDashboardStats();
});

function loadDashboardStats() {
    // Simular carga de estadísticas con datos más realistas
    setTimeout(() => {
        // Animar los números
        animateNumber('totalInsumos', 0, 24, 1000);
        animateNumber('totalProveedores', 0, 8, 800);
        animateNumber('insumosLowStock', 0, 3, 600);
        
        // Actualizar valor total con formato de moneda
        document.getElementById('valorTotal').textContent = '$2,450,000';
    }, 300);
}

function animateNumber(elementId, start, end, duration) {
    const element = document.getElementById(elementId);
    const range = end - start;
    const startTime = performance.now();

    function updateNumber(currentTime) {
        const elapsed = currentTime - startTime;
        const progress = Math.min(elapsed / duration, 1);
        const current = Math.floor(start + (range * progress));
        
        element.textContent = current.toLocaleString();
        
        if (progress < 1) {
            requestAnimationFrame(updateNumber);
        }
    }
    
    requestAnimationFrame(updateNumber);
}

function showComingSoon() {
    // Crear notificación elegante en lugar de alert
    showNotification('Esta funcionalidad estará disponible próximamente', 'info');
}

function checkLowStock() {
    // Simular verificación de stock bajo
    showNotification('Verificando productos con stock bajo...', 'warning');
    setTimeout(() => {
        window.location.href = "{{ route('insumos.index') }}";
    }, 1000);
}

function checkSystemStatus() {
    showNotification('Sistema funcionando correctamente ✓', 'success');
}

function showTips() {
    showNotification('💡 Consejo: Configura alertas automáticas para el stock mínimo', 'info');
}

function showNotification(message, type) {
    // Crear elemento de notificación
    const notification = document.createElement('div');
    notification.className = `alert alert-${type} notification-toast`;
    notification.innerHTML = `
        <div class="d-flex align-items-center">
            <i class="fas fa-${getNotificationIcon(type)} me-2"></i>
            <span>${message}</span>
        </div>
    `;
    
    // Estilos para la notificación
    notification.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 9999;
        min-width: 300px;
        padding: 15px;
        border-radius: 8px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.15);
        transform: translateX(400px);
        transition: transform 0.3s ease;
    `;
    
    document.body.appendChild(notification);
    
    // Animar entrada
    setTimeout(() => {
        notification.style.transform = 'translateX(0)';
    }, 100);
    
    // Remover después de 3 segundos
    setTimeout(() => {
        notification.style.transform = 'translateX(400px)';
        setTimeout(() => {
            document.body.removeChild(notification);
        }, 300);
    }, 3000);
}

function getNotificationIcon(type) {
    const icons = {
        'success': 'check-circle',
        'warning': 'exclamation-triangle',
        'info': 'info-circle',
        'danger': 'exclamation-circle'
    };
    return icons[type] || 'info-circle';
}
</script>
@endpush