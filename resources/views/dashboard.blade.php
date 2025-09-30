@extends('layouts.app')

@section('title', 'Dashboard - La Comarca Admin')

@section('content')
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
                    <a class="nav-link active" href="{{ route('dashboard') }}">
                        <i class="fas fa-home"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('insumos.index') }}">
                        <i class="fas fa-boxes"></i>
                        <span>Insumos</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('proveedor.index') }}">
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
                <a href="{{ route('welcome') }}" class="btn btn-outline-danger btn-sm">
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
                                <a href="{{ route('insumos.index') }}" class="action-btn">
                                    <i class="fas fa-plus"></i>
                                    <span>Nuevo Insumo</span>
                                </a>
                                <a href="{{ route('proveedor.index') }}" class="action-btn">
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<!-- Mobile Sidebar Overlay -->
<div class="sidebar-overlay d-lg-none" id="sidebarOverlay"></div>

@endsection

@push('styles')
<style>
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
</style>
@endpush

@push('scripts')
<script>
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
</script>
@endpush