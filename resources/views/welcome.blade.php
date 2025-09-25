@extends('layouts.app')

@section('title', 'Inicio - La Comarca Admin')

@section('content')
<div class="text-center py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <i class="fas fa-utensils fa-5x text-primary mb-4"></i>
            <h1 class="display-4">Bienvenido a La Comarca Admin</h1>
            <p class="lead">Sistema de gestión para el restaurante La Comarca</p>
            
            <div class="row mt-5">
                <div class="col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <i class="fas fa-boxes fa-3x text-success mb-3"></i>
                            <h3>Gestión de Insumos</h3>
                            <p class="text-muted">Administra el inventario de insumos del restaurante</p>
                            <a href="{{ route('insumos.index') }}" class="btn btn-success">
                                <i class="fas fa-arrow-right"></i> Ir a Insumos
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <i class="fas fa-truck fa-3x text-info mb-3"></i>
                            <h3>Gestión de Proveedores</h3>
                            <p class="text-muted">Administra los proveedores y sus relaciones</p>
                            <a href="{{ route('proveedores.index') }}" class="btn btn-info">
                                <i class="fas fa-arrow-right"></i> Ir a Proveedores
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection