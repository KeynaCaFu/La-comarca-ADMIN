<?php

use App\Http\Controllers\InsumoController;
use App\Http\Controllers\ProveedorController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('insumos', InsumoController::class);
Route::resource('proveedores', ProveedorController::class);