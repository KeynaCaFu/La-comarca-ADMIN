

<?php $__env->startSection('title', 'Dashboard - La Comarca Admin'); ?>

<?php $__env->startSection('content'); ?>
<<<<<<< HEAD
<div class="dashboard-container">
    <!-- Sidebar -->
    <nav class="sidebar">
        <div class="sidebar-header">
            <div class="sidebar-brand">
                <i class="fas fa-utensils me-2"></i>
                <span>La Comarca</span>
            </div>
            <button class="sidebar-toggle d-lg-none" id="sidebarToggle">
                <i class="fas fa-times"></i>
            </button>
        </div>
        
        <div class="sidebar-menu">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link active" href="<?php echo e(route('dashboard')); ?>">
                        <i class="fas fa-home"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(route('insumos.index')); ?>">
                        <i class="fas fa-boxes"></i>
                        <span>Insumos</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(route('proveedor.index')); ?>">
                        <i class="fas fa-truck"></i>
                        <span>Proveedores</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" onclick="alert('Próximamente...')">
                        <i class="fas fa-chart-line"></i>
                        <span>Reportes</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" onclick="alert('Próximamente...')">
                        <i class="fas fa-cog"></i>
                        <span>Configuración</span>
                    </a>
                </li>
            </ul>
        </div>
        
        <div class="sidebar-footer">
            <div class="user-info">
                <i class="fas fa-user-circle"></i>
                <span>Administrador</span>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Header -->
        <header class="main-header">
            <div class="header-left">
                <button class="sidebar-toggle d-lg-none" id="mobileToggle">
                    <i class="fas fa-bars"></i>
                </button>
                <h1 class="page-title">Dashboard</h1>
            </div>
            <div class="header-right">
                <button class="btn btn-outline-secondary btn-sm me-2">
                    <i class="fas fa-bell"></i>
                </button>
                <a href="<?php echo e(route('welcome')); ?>" class="btn btn-outline-danger btn-sm">
                    <i class="fas fa-sign-out-alt"></i>
                    Salir
                </a>
            </div>
        </header>

        <!-- Dashboard Content -->
        <div class="dashboard-content">
            <div class="row">
                <!-- Stats Cards -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-boxes"></i>
                        </div>
                        <div class="stat-info">
                            <h3 id="totalInsumos">0</h3>
                            <p>Total Insumos</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-truck"></i>
                        </div>
                        <div class="stat-info">
                            <h3 id="totalProveedores">0</h3>
                            <p>Total Proveedores</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <div class="stat-info">
                            <h3 id="insumosLowStock">0</h3>
                            <p>Stock Bajo</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                        <div class="stat-info">
                            <h3>$0</h3>
                            <p>Valor Total</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="row">
                <div class="col-lg-6 mb-4">
                    <div class="action-card">
                        <div class="card-header">
                            <h5><i class="fas fa-plus-circle me-2"></i>Acciones Rápidas</h5>
                        </div>
                        <div class="card-body">
                            <div class="quick-actions">
                                <a href="<?php echo e(route('insumos.index')); ?>" class="action-btn">
                                    <i class="fas fa-plus"></i>
                                    <span>Nuevo Insumo</span>
                                </a>
                                <a href="<?php echo e(route('proveedor.index')); ?>" class="action-btn">
                                    <i class="fas fa-user-plus"></i>
                                    <span>Nuevo Proveedor</span>
                                </a>
                                <a href="#" class="action-btn" onclick="alert('Próximamente...')">
                                    <i class="fas fa-file-alt"></i>
                                    <span>Ver Reportes</span>
                                </a>
                                <a href="#" class="action-btn" onclick="alert('Próximamente...')">
                                    <i class="fas fa-download"></i>
                                    <span>Exportar Datos</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-6 mb-4">
                    <div class="action-card">
                        <div class="card-header">
                            <h5><i class="fas fa-clock me-2"></i>Actividad Reciente</h5>
                        </div>
                        <div class="card-body">
                            <div class="activity-list">
                                <div class="activity-item">
                                    <i class="fas fa-plus text-success"></i>
                                    <span>Sistema iniciado correctamente</span>
                                    <small class="text-muted">Hace un momento</small>
                                </div>
                                <div class="activity-item">
                                    <i class="fas fa-info text-info"></i>
                                    <span>Dashboard cargado</span>
                                    <small class="text-muted">Ahora</small>
                                </div>
=======
<!-- Dashboard Content -->
<div class="dashboard-content">
    <div class="row">
        <!-- Stats Cards -->
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="stat-card">
                <div class="stat-icon bg-primary">
                    <i class="fas fa-boxes"></i>
                </div>
                <div class="stat-info">
                    <h3 id="totalInsumos">0</h3>
                    <p>Total Insumos</p>
                </div>
                <div class="stat-trend">
                    <i class="fas fa-arrow-up text-success"></i>
                    <span class="text-success">+12%</span>
                </div>
            </div>
        </div>
        
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="stat-card">
                <div class="stat-icon bg-success">
                    <i class="fas fa-truck"></i>
                </div>
                <div class="stat-info">
                    <h3 id="totalProveedores">0</h3>
                    <p>Total Proveedores</p>
                </div>
                <div class="stat-trend">
                    <i class="fas fa-arrow-up text-success"></i>
                    <span class="text-success">+5%</span>
                </div>
            </div>
        </div>
        
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="stat-card">
                <div class="stat-icon bg-warning">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <div class="stat-info">
                    <h3 id="insumosLowStock">0</h3>
                    <p>Stock Bajo</p>
                </div>
                <div class="stat-trend">
                    <i class="fas fa-arrow-down text-warning"></i>
                    <span class="text-warning">-2</span>
                </div>
            </div>
        </div>
        
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="stat-card">
                <div class="stat-icon bg-info">
                    <i class="fas fa-dollar-sign"></i>
                </div>
                <div class="stat-info">
                    <h3 id="valorTotal">₡0</h3>
                    <p>Valor Total Inventario</p>
                </div>
                <div class="stat-trend">
                    <i class="fas fa-arrow-up text-success"></i>
                    <span class="text-success">+8%</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions & Recent Activity Row -->
    <div class="row">
        <!-- Quick Actions -->
        <div class="col-lg-6 mb-4">
            <div class="action-card">
                <div class="card-header">
                    <h5><i class="fas fa-bolt me-2"></i>Acciones Rápidas</h5>
                </div>
                <div class="card-body">
                    <div class="quick-actions-grid">
                        <a href="<?php echo e(route('insumos.index')); ?>" class="action-btn action-btn-primary">
                            <div class="action-icon">
                                <i class="fas fa-plus"></i>
                            </div>
                            <div class="action-text">
                                <span class="action-title">Nuevo Insumo</span>
                                <span class="action-subtitle">Agregar producto al inventario</span>
                            </div>
                        </a>
                        
                        <a href="<?php echo e(route('proveedor.index')); ?>" class="action-btn action-btn-success">
                            <div class="action-icon">
                                <i class="fas fa-user-plus"></i>
                            </div>
                            <div class="action-text">
                                <span class="action-title">Nuevo Proveedor</span>
                                <span class="action-subtitle">Registrar nuevo proveedor</span>
                            </div>
                        </a>
                        
                        <a href="#" class="action-btn action-btn-info" onclick="showComingSoon()">
                            <div class="action-icon">
                                <i class="fas fa-chart-bar"></i>
                            </div>
                            <div class="action-text">
                                <span class="action-title">Ver Reportes</span>
                                <span class="action-subtitle">Estadísticas y análisis</span>
                            </div>
                        </a>
                        
                        <a href="#" class="action-btn action-btn-warning" onclick="showComingSoon()">
                            <div class="action-icon">
                                <i class="fas fa-download"></i>
                            </div>
                            <div class="action-text">
                                <span class="action-title">Exportar Datos</span>
                                <span class="action-subtitle">Descargar información</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Recent Activity -->
        <div class="col-lg-6 mb-4">
            <div class="action-card">
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
                                <h6>Sistema iniciado correctamente</h6>
                                <p class="text-muted">Bienvenido a La Comarca Admin</p>
                                <small class="text-muted">Hace un momento</small>
                            </div>
                        </div>
                        
                        <div class="activity-item">
                            <div class="activity-icon bg-info">
                                <i class="fas fa-tachometer-alt"></i>
                            </div>
                            <div class="activity-content">
                                <h6>Dashboard cargado</h6>
                                <p class="text-muted">Estadísticas actualizadas</p>
                                <small class="text-muted">Ahora</small>
                            </div>
                        </div>
                        
                        <div class="activity-item">
                            <div class="activity-icon bg-primary">
                                <i class="fas fa-database"></i>
                            </div>
                            <div class="activity-content">
                                <h6>Base de datos conectada</h6>
                                <p class="text-muted">Conexión establecida con bdsage</p>
                                <small class="text-muted">Hace 1 minuto</small>
>>>>>>> main
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<<<<<<< HEAD
    </main>
</div>

<!-- Mobile Sidebar Overlay -->
<div class="sidebar-overlay d-lg-none" id="sidebarOverlay"></div>

=======
    </div>

    <!-- Additional Info Row -->
    <div class="row">
        <!-- Low Stock Alert -->
        <div class="col-lg-4 mb-4">
            <div class="alert-card alert-warning">
                <div class="alert-header">
                    <i class="fas fa-exclamation-triangle"></i>
                    <h6>Alerta de Stock Bajo</h6>
                </div>
                <div class="alert-body">
                    <p>Hay productos que requieren atención</p>
                    <button class="btn btn-warning btn-sm" onclick="checkLowStock()">
                        Ver Productos
                    </button>
                </div>
            </div>
        </div>
        
        <!-- System Status -->
        <div class="col-lg-4 mb-4">
            <div class="alert-card alert-success">
                <div class="alert-header">
                    <i class="fas fa-check-circle"></i>
                    <h6>Estado del Sistema</h6>
                </div>
                <div class="alert-body">
                    <p>Todos los servicios funcionando correctamente</p>
                    <button class="btn btn-success btn-sm" onclick="checkSystemStatus()">
                        Ver Detalles
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Quick Tips -->
        <div class="col-lg-4 mb-4">
            <div class="alert-card alert-info">
                <div class="alert-header">
                    <i class="fas fa-lightbulb"></i>
                    <h6>Consejo del Día</h6>
                </div>
                <div class="alert-body">
                    <p>Mantén siempre actualizado el stock mínimo de tus productos</p>
                    <button class="btn btn-info btn-sm" onclick="showTips()">
                        Más Consejos
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
>>>>>>> main
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<style>
<<<<<<< HEAD
    /* Dashboard Layout */
    .dashboard-container {
        display: flex;
        min-height: 100vh;
        background: #f8f9fa;
    }

    /* Sidebar Styles */
    .sidebar {
        width: 280px;
        background: linear-gradient(180deg, #485a1a 0%, #232c0c 100%);
        color: white;
        display: flex;
        flex-direction: column;
        position: fixed;
        height: 100vh;
        left: 0;
        top: 0;
        z-index: 1000;
        transform: translateX(0);
        transition: transform 0.3s ease;
    }

    .sidebar-header {
        padding: 20px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .sidebar-brand {
        font-size: 1.5rem;
        font-weight: bold;
        display: flex;
        align-items: center;
    }

    .sidebar-toggle {
        background: none;
        border: none;
        color: white;
        font-size: 1.2rem;
        cursor: pointer;
    }

    .sidebar-menu {
        flex: 1;
        padding: 20px 0;
    }

    .sidebar-menu .nav-link {
        color: rgba(255, 255, 255, 0.8);
        padding: 15px 25px;
        display: flex;
        align-items: center;
        text-decoration: none;
        transition: all 0.3s ease;
        border-left: 3px solid transparent;
    }

    .sidebar-menu .nav-link:hover,
    .sidebar-menu .nav-link.active {
        color: white;
        background: rgba(255, 255, 255, 0.1);
        border-left-color: #ff9900;
    }

    .sidebar-menu .nav-link i {
        width: 20px;
        margin-right: 15px;
        text-align: center;
    }

    .sidebar-footer {
        padding: 20px;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
    }

    .user-info {
        display: flex;
        align-items: center;
        color: rgba(255, 255, 255, 0.8);
    }

    .user-info i {
        margin-right: 10px;
        font-size: 1.5rem;
    }

    /* Main Content */
    .main-content {
        flex: 1;
        margin-left: 280px;
        display: flex;
        flex-direction: column;
    }

    .main-header {
        background: white;
        padding: 20px 30px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .header-left {
        display: flex;
        align-items: center;
    }

    .page-title {
        margin: 0;
        font-size: 1.8rem;
        color: #232c0c;
        margin-left: 15px;
    }

    .dashboard-content {
        padding: 30px;
        flex: 1;
    }

    /* Stat Cards */
    .stat-card {
        background: white;
        border-radius: 12px;
        padding: 25px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        display: flex;
        align-items: center;
        transition: transform 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-5px);
    }

    .stat-icon {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, #485a1a, #5a6d20);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 20px;
    }

    .stat-icon i {
        font-size: 1.8rem;
        color: white;
    }

    .stat-info h3 {
        margin: 0;
        font-size: 2rem;
        font-weight: bold;
        color: #232c0c;
    }

    .stat-info p {
        margin: 5px 0 0 0;
        color: #6c757d;
        font-size: 0.9rem;
    }

    /* Action Cards */
    .action-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        height: 100%;
    }

    .action-card .card-header {
        background: #f8f9fa;
        border-bottom: 1px solid #e9ecef;
        padding: 20px 25px;
        border-radius: 12px 12px 0 0;
    }

    .action-card .card-header h5 {
        margin: 0;
        color: #232c0c;
        font-weight: 600;
    }

    .action-card .card-body {
        padding: 25px;
    }

    .quick-actions {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 15px;
    }

    .action-btn {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 20px;
        background: #f8f9fa;
        border-radius: 8px;
        text-decoration: none;
        color: #485a1a;
        transition: all 0.3s ease;
    }

    .action-btn:hover {
        background: #485a1a;
        color: white;
        transform: translateY(-2px);
    }

    .action-btn i {
        font-size: 1.5rem;
        margin-bottom: 8px;
    }

    .activity-list {
        max-height: 200px;
        overflow-y: auto;
    }

    .activity-item {
        display: flex;
        align-items: center;
        padding: 10px 0;
        border-bottom: 1px solid #f0f0f0;
    }

    .activity-item:last-child {
        border-bottom: none;
    }

    .activity-item i {
        margin-right: 15px;
        width: 20px;
        text-align: center;
    }

    .activity-item span {
        flex: 1;
        margin-right: 10px;
    }

    .activity-item small {
        font-size: 0.8rem;
    }

    /* Mobile Responsive */
    @media (max-width: 991.98px) {
        .sidebar {
            transform: translateX(-100%);
        }

        .sidebar.show {
            transform: translateX(0);
        }

        .main-content {
            margin-left: 0;
        }

        .sidebar-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
            display: none;
        }

        .sidebar-overlay.show {
            display: block;
        }

        .quick-actions {
            grid-template-columns: 1fr;
        }

        .dashboard-content {
            padding: 20px;
        }

        .main-header {
            padding: 15px 20px;
        }

        .page-title {
            font-size: 1.5rem;
        }
    }

    @media (max-width: 767.98px) {
        .stat-card {
            flex-direction: column;
            text-align: center;
        }

        .stat-icon {
            margin-right: 0;
            margin-bottom: 15px;
        }
    }
=======
/* Dashboard Content */
.dashboard-content {
    padding: 30px;
    background: #f8f9fa;
    min-height: calc(100vh - 80px);
}

/* Enhanced Stat Cards */
.stat-card {
    background: white;
    border-radius: 15px;
    padding: 25px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    display: flex;
    align-items: center;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
}

.stat-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 3px;
    background: linear-gradient(90deg, #485a1a, #ff9900);
}

.stat-icon {
    width: 65px;
    height: 65px;
    border-radius: 15px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 20px;
    position: relative;
}

.stat-icon.bg-primary {
    background: linear-gradient(135deg, #485a1a, #5a6d20);
}

.stat-icon.bg-success {
    background: linear-gradient(135deg, #28a745, #20c997);
}

.stat-icon.bg-warning {
    background: linear-gradient(135deg, #ffc107, #ff9900);
}

.stat-icon.bg-info {
    background: linear-gradient(135deg, #17a2b8, #007bff);
}

.stat-icon i {
    font-size: 1.8rem;
    color: white;
}

.stat-info {
    flex: 1;
}

.stat-info h3 {
    margin: 0;
    font-size: 2.2rem;
    font-weight: 700;
    color: #232c0c;
    line-height: 1;
}

.stat-info p {
    margin: 5px 0 0 0;
    color: #6c757d;
    font-size: 0.95rem;
    font-weight: 500;
}

.stat-trend {
    text-align: right;
    display: flex;
    flex-direction: column;
    align-items: flex-end;
}

.stat-trend i {
    font-size: 1.2rem;
    margin-bottom: 2px;
}

.stat-trend span {
    font-size: 0.85rem;
    font-weight: 600;
}

/* Enhanced Action Cards */
.action-card {
    background: white;
    border-radius: 15px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    height: 100%;
    transition: all 0.3s ease;
}

.action-card:hover {
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
}

.action-card .card-header {
    background: linear-gradient(135deg, #f8f9fa, #e9ecef);
    border-bottom: 1px solid #e9ecef;
    padding: 20px 25px;
    border-radius: 15px 15px 0 0;
    border-bottom: none;
}

.action-card .card-header h5 {
    margin: 0;
    color: #232c0c;
    font-weight: 600;
    font-size: 1.1rem;
}

.action-card .card-body {
    padding: 25px;
}

/* Quick Actions Grid */
.quick-actions-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 15px;
}

.action-btn {
    display: flex;
    align-items: center;
    padding: 18px;
    border-radius: 12px;
    text-decoration: none;
    transition: all 0.3s ease;
    border: 2px solid transparent;
    background: #f8f9fa;
}

.action-btn:hover {
    transform: translateX(5px);
    text-decoration: none;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

.action-btn-primary:hover {
    background: #485a1a;
    color: white;
    border-color: #485a1a;
}

.action-btn-success:hover {
    background: #28a745;
    color: white;
    border-color: #28a745;
}

.action-btn-info:hover {
    background: #17a2b8;
    color: white;
    border-color: #17a2b8;
}

.action-btn-warning:hover {
    background: #ffc107;
    color: #212529;
    border-color: #ffc107;
}

.action-icon {
    width: 50px;
    height: 50px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 15px;
    background: rgba(72, 90, 26, 0.1);
    color: #485a1a;
}

.action-btn:hover .action-icon {
    background: rgba(255, 255, 255, 0.2);
    color: inherit;
}

.action-icon i {
    font-size: 1.4rem;
}

.action-text {
    display: flex;
    flex-direction: column;
}

.action-title {
    font-weight: 600;
    font-size: 1rem;
    margin-bottom: 2px;
    color: #232c0c;
}

.action-btn:hover .action-title {
    color: inherit;
}

.action-subtitle {
    font-size: 0.85rem;
    color: #6c757d;
    opacity: 0.8;
}

.action-btn:hover .action-subtitle {
    color: inherit;
    opacity: 0.9;
}

/* Activity Timeline */
.activity-timeline {
    max-height: 300px;
    overflow-y: auto;
}

.activity-item {
    display: flex;
    align-items: flex-start;
    padding: 15px 0;
    border-bottom: 1px solid #f0f0f0;
}

.activity-item:last-child {
    border-bottom: none;
}

.activity-icon {
    width: 40px;
    height: 40px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 15px;
    flex-shrink: 0;
}

.activity-icon i {
    font-size: 1rem;
    color: white;
}

.activity-content h6 {
    margin: 0 0 5px 0;
    font-size: 0.95rem;
    font-weight: 600;
    color: #232c0c;
}

.activity-content p {
    margin: 0 0 5px 0;
    font-size: 0.85rem;
    color: #6c757d;
}

.activity-content small {
    font-size: 0.75rem;
    color: #adb5bd;
}

/* Alert Cards */
.alert-card {
    background: white;
    border-radius: 12px;
    padding: 20px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    height: 100%;
    border-left: 4px solid;
    transition: all 0.3s ease;
}

.alert-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.12);
}

.alert-card.alert-warning {
    border-left-color: #ffc107;
}

.alert-card.alert-success {
    border-left-color: #28a745;
}

.alert-card.alert-info {
    border-left-color: #17a2b8;
}

.alert-header {
    display: flex;
    align-items: center;
    margin-bottom: 15px;
}

.alert-header i {
    font-size: 1.2rem;
    margin-right: 10px;
}

.alert-warning .alert-header i {
    color: #ffc107;
}

.alert-success .alert-header i {
    color: #28a745;
}

.alert-info .alert-header i {
    color: #17a2b8;
}

.alert-header h6 {
    margin: 0;
    font-weight: 600;
    color: #232c0c;
}

.alert-body p {
    margin-bottom: 15px;
    color: #6c757d;
    font-size: 0.9rem;
}

.alert-body .btn {
    font-size: 0.85rem;
    padding: 6px 15px;
}

/* Responsive Design */
@media (max-width: 991.98px) {
    .dashboard-content {
        padding: 20px 15px;
    }
    
    .quick-actions-grid {
        gap: 10px;
    }
    
    .action-btn {
        padding: 15px;
    }
    
    .stat-card {
        margin-bottom: 20px;
    }
}

@media (max-width: 767.98px) {
    .stat-card {
        flex-direction: column;
        text-align: center;
        padding: 20px;
    }
    
    .stat-icon {
        margin-right: 0;
        margin-bottom: 15px;
    }
    
    .stat-trend {
        align-items: center;
        margin-top: 10px;
    }
    
    .action-btn {
        flex-direction: column;
        text-align: center;
        padding: 20px;
    }
    
    .action-icon {
        margin-right: 0;
        margin-bottom: 10px;
    }
}
>>>>>>> main
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
<<<<<<< HEAD
    document.addEventListener('DOMContentLoaded', function() {
        // Sidebar toggle functionality
        const sidebar = document.querySelector('.sidebar');
        const sidebarOverlay = document.getElementById('sidebarOverlay');
        const toggleButtons = document.querySelectorAll('.sidebar-toggle');

        toggleButtons.forEach(button => {
            button.addEventListener('click', function() {
                if (window.innerWidth < 992) {
                    sidebar.classList.toggle('show');
                    sidebarOverlay.classList.toggle('show');
                }
            });
        });

        // Close sidebar when clicking overlay
        sidebarOverlay.addEventListener('click', function() {
            sidebar.classList.remove('show');
            sidebarOverlay.classList.remove('show');
        });

        // Load dashboard stats
        loadDashboardStats();
    });

    function loadDashboardStats() {
        // Simular carga de estadísticas
        // En una implementación real, harías peticiones AJAX aquí
        
        // Simular datos
        setTimeout(() => {
            document.getElementById('totalInsumos').textContent = '24';
            document.getElementById('totalProveedores').textContent = '8';
            document.getElementById('insumosLowStock').textContent = '3';
        }, 500);
    }
=======
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
        window.location.href = "<?php echo e(route('insumos.index')); ?>";
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
>>>>>>> main
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\La-comarca-ADMIN\resources\views/dashboard.blade.php ENDPATH**/ ?>