<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Categorias;
use App\Http\Controllers\Clientes;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\DetalleVentas;
use App\Http\Controllers\Productos;
use App\Http\Controllers\Usuarios;
use App\Http\Controllers\Ventas;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'index'])->name('login');
Route::get('/home', [Dashboard::class, 'index'])->name('home');

Route::prefix('ventas')->group(function(){
    Route::get('/nueva-venta', [Ventas::class, 'index'])->name('ventas-nueva');
});

Route::prefix('detalle')->group(function(){
    Route::get('/detalle-venta', [DetalleVentas::class, 'index'])->name('detalle-venta');
});

Route::prefix('categorias')->group(function(){
    Route::get('/', [Categorias::class, 'index'])->name('categorias');
});

Route::prefix('productos')->group(function(){
    Route::get('/', [Productos::class, 'index'])->name('productos');
});

Route::prefix('clientes')->group(function(){
    Route::get('/', [Clientes::class, 'index'])->name('clientes');
});

Route::prefix('usuarios')->group(function(){
    Route::get('/', [Usuarios::class, 'index'])->name('usuarios');
});