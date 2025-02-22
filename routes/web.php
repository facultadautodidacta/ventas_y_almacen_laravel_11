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

//crear un usuario admin, solo usar una vez
//Route::get('/crear-admin', [AuthController::class, 'crearAdmin']);

Route::get('/', [AuthController::class, 'index'])->name('login');
Route::post('/logear', [AuthController::class, 'logear'])->name('logear');


Route::middleware("auth")->group(function(){
    Route::get('/home', [Dashboard::class, 'index'])->name('home');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::prefix('ventas')->group(function(){
    Route::get('/nueva-venta', [Ventas::class, 'index'])->name('ventas-nueva');
});

Route::prefix('detalle')->middleware('auth')->group(function(){
    Route::get('/detalle-venta', [DetalleVentas::class, 'index'])->name('detalle-venta');
});

Route::prefix('categorias')->middleware('auth')->group(function(){
    Route::get('/', [Categorias::class, 'index'])->name('categorias');
});

Route::prefix('productos')->middleware('auth')->group(function(){
    Route::get('/', [Productos::class, 'index'])->name('productos');
});

Route::prefix('clientes')->middleware('auth')->group(function(){
    Route::get('/', [Clientes::class, 'index'])->name('clientes');
});

Route::prefix('usuarios')->middleware('auth')->group(function(){
    Route::get('/', [Usuarios::class, 'index'])->name('usuarios');
});