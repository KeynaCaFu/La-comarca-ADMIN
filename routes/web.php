<?php

use App\Http\Controllers\InsumoController;
use App\Http\Controllers\ProveedorController;
use Illuminate\Support\Facades\Route;

// Página de bienvenida inicial
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Dashboard principal del sistema
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// Rutas de Insumos
Route::resource('insumos', InsumoController::class);
Route::get('insumos/{id}/show-modal', [InsumoController::class, 'showModal'])->name('insumos.show-modal');
Route::get('insumos/{id}/edit-modal', [InsumoController::class, 'editModal'])->name('insumos.edit-modal');

// Rutas de Proveedores (corregidas)
Route::resource('proveedor', ProveedorController::class);
Route::get('proveedor/{id}/show-modal', [ProveedorController::class, 'showModal'])->name('proveedor.show-modal');
Route::get('proveedor/{id}/edit-modal', [ProveedorController::class, 'editModal'])->name('proveedor.edit-modal');