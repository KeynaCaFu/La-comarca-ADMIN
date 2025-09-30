<?php

use App\Http\Controllers\InsumoController;
use App\Http\Controllers\ProveedorController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('insumos', InsumoController::class);
Route::get('insumos/{id}/show-modal', [InsumoController::class, 'showModal'])->name('insumos.show-modal');
Route::get('insumos/{id}/edit-modal', [InsumoController::class, 'editModal'])->name('insumos.edit-modal');

Route::resource('proveedores', ProveedorController::class);
Route::get('proveedores/{id}/show-modal', [ProveedorController::class, 'showModal'])->name('proveedores.show-modal');
Route::get('proveedores/{id}/edit-modal', [ProveedorController::class, 'editModal'])->name('proveedores.edit-modal');