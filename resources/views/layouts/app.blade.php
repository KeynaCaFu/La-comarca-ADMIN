<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <meta name="description" content="La Comarca - Sistema de administración de inventario">
    <meta name="theme-color" content="#485a1a">
    <title>@yield('title', 'La Comarca - Admin')</title>
    
    <!-- Preload critical resources -->
    <link rel="preconnect" href="https://cdn.jsdelivr.net">
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <!-- CSS Personalizado La Comarca -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/fixes.css') }}" rel="stylesheet">
    <link href="{{ asset('css/modals.css') }}" rel="stylesheet">
    @stack('styles')
</head>
<body>
    <!-- Mobile Header -->
    <div class="mobile-header d-lg-none">
        <div class="d-flex justify-content-between align-items-center p-3">
            <button class="btn btn-link mobile-menu-toggle" type="button" aria-label="Toggle navigation">
                <i class="fas fa-bars text-white fs-4"></i>
            </button>
            <h4 class="text-white mb-0"><i class="fas fa-utensils me-2"></i>La Comarca</h4>
            <div></div> <!-- Spacer for centering -->
        </div>
    </div>

    <!-- Mobile Menu Overlay -->
    <div class="mobile-menu-overlay d-lg-none"></div>

    <!-- Container principal con diseño La Comarca -->
    <div class="container">
        <!-- Sidebar -->
        <nav class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <h3><i class="fas fa-utensils"></i> <span class="sidebar-text">La Comarca</span></h3>
                <button class="btn btn-link sidebar-close d-lg-none" aria-label="Close sidebar">
                    <i class="fas fa-times text-white"></i>
                </button>
            </div>
            <div class="sidebar-menu">
                <ul>
                    <li>
                        <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                            <i class="fas fa-home"></i> <span class="sidebar-text">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('insumos.index') }}" class="{{ request()->routeIs('insumos*') ? 'active' : '' }}">
                            <i class="fas fa-boxes"></i> <span class="sidebar-text">Insumos</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('proveedor.index') }}" class="{{ request()->routeIs('proveedor*') ? 'active' : '' }}">
                            <i class="fas fa-truck"></i> <span class="sidebar-text">Proveedores</span>
                        </a>
                    </li>
                    <li class="mt-3">
                        <a href="{{ route('welcome') }}" class="text-danger">
                            <i class="fas fa-sign-out-alt"></i> <span class="sidebar-text">Salir</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Contenido principal -->
        <main class="main-content">
            <!-- Header -->
            <div class="header">
                <h1>@yield('title', 'Dashboard')</h1>
                <div class="user-info">
                    <i class="fas fa-user-circle fa-2x"></i>
                    <span>Administrador</span>
                </div>
            </div>

            <!-- Alertas de Bootstrap/Laravel -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-triangle"></i>
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Contenido específico de cada página -->
            <div class="fade-in">
                @yield('content')
            </div>
        </main>
    </div>

    <!-- Scripts de Bootstrap y JavaScript personalizado -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Mobile Navigation Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuToggle = document.querySelector('.mobile-menu-toggle');
            const sidebar = document.getElementById('sidebar');
            const overlay = document.querySelector('.mobile-menu-overlay');
            const sidebarClose = document.querySelector('.sidebar-close');
            
            function openSidebar() {
                sidebar.classList.add('sidebar-open');
                overlay.classList.add('active');
                document.body.classList.add('sidebar-opened');
            }
            
            function closeSidebar() {
                sidebar.classList.remove('sidebar-open');
                overlay.classList.remove('active');
                document.body.classList.remove('sidebar-opened');
            }
            
            if (mobileMenuToggle) {
                mobileMenuToggle.addEventListener('click', openSidebar);
            }
            
            if (overlay) {
                overlay.addEventListener('click', closeSidebar);
            }
            
            if (sidebarClose) {
                sidebarClose.addEventListener('click', closeSidebar);
            }
            
            // Close sidebar when clicking on menu items on mobile
            const sidebarLinks = sidebar.querySelectorAll('.sidebar-menu a');
            sidebarLinks.forEach(link => {
                link.addEventListener('click', function() {
                    if (window.innerWidth < 992) {
                        closeSidebar();
                    }
                });
            });
            
            // Handle resize events
            window.addEventListener('resize', function() {
                if (window.innerWidth >= 992) {
                    closeSidebar();
                }
            });
        });
    </script>
    
    @stack('scripts')
</body>
</html>