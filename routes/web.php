<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Categorias;
use App\Http\Controllers\Clientes;
use App\Http\Controllers\Compras;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\DetalleVentas;
use App\Http\Controllers\Productos;
use App\Http\Controllers\Proveedores;
use App\Http\Controllers\Reportes_productos;
use App\Http\Controllers\Usuarios;
use App\Http\Controllers\Ventas;
use Illuminate\Support\Facades\Route;

//crear un usuario admin, solo usar una vez
Route::get('/crear-admin', [AuthController::class, 'crearAdmin']);

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
    Route::get('/create', [Categorias::class, 'create'])->name('categorias.create');
    Route::post('/store', [Categorias::class, 'store'])->name('categorias.store');
    Route::get('/show/{id}', [Categorias::class, 'show'])->name('categorias.show');
    Route::delete('/destroy/{id}', [Categorias::class, 'destroy'])->name('categorias.destroy');
    Route::get('/edit/{id}', [Categorias::class, 'edit'])->name('categorias.edit');
    Route::put('/update/{id}', [Categorias::class, 'update'])->name('categorias.update');
});

Route::prefix('productos')->middleware('auth')->group(function(){
    Route::get('/', [Productos::class, 'index'])->name('productos');
    Route::get('/create', [Productos::class, 'create'])->name('productos.create');
    Route::post('/store', [Productos::class, 'store'])->name('productos.store');
    Route::get('/edit/{id}', [Productos::class, 'edit'])->name('productos.edit');
    Route::put('/update/{id}', [Productos::class, 'update'])->name('productos.update');
    
    Route::get('/show-image/{id}', [Productos::class, 'show_image'])->name('productos.show.image');
    Route::put('/update-image/{id}', [Productos::class, 'update_image'])->name('productos.update.image');
    
    Route::get('/show/{id}', [Productos::class, 'show'])->name('productos.show');
    Route::delete('/destroy/{id}', [Productos::class, 'destroy'])->name('productos.destroy');
    Route::get('/cambiar-estado/{id}/{estado}', [Productos::class, 'estado'])->name('productos.estado');
});

Route::prefix('reportes_productos')->middleware('auth')->group(function(){
    Route::get('/', [Reportes_productos::class, 'index'])->name('reportes_productos');
    Route::get('/falta-stock', [Reportes_productos::class, 'falta_stock'])->name('reportes_productos.falta_stock');
});


Route::prefix('proveedores')->middleware('auth')->group(function(){
    Route::get('/', [Proveedores::class, 'index'])->name('proveedores');
    Route::get('/create', [Proveedores::class, 'create'])->name('proveedores.create');
    Route::post('/store', [Proveedores::class, 'store'])->name('proveedores.store');
    Route::get('/edit/{id}', [Proveedores::class, 'edit'])->name('proveedores.edit');
    Route::put('/update/{id}', [Proveedores::class, 'update'])->name('proveedores.update');
    Route::get('/show/{id}', [Proveedores::class, 'show'])->name('proveedores.show');
    Route::delete('/destroy/{id}', [Proveedores::class, 'destroy'])->name('proveedores.destroy');
});

Route::prefix('usuarios')->middleware('auth')->group(function(){
    Route::get('/', [Usuarios::class, 'index'])->name('usuarios');
    Route::get('/create', [Usuarios::class, 'create'])->name('usuarios.create');
    Route::post('/store', [Usuarios::class, 'store'])->name('usuarios.store');
    Route::get('/edit/{id}', [Usuarios::class, 'edit'])->name('usuarios.edit');
    Route::put('/update/{id}', [Usuarios::class, 'update'])->name('usuarios.update');
    Route::get('/tbody', [Usuarios::class, 'tbody'])->name('usuarios.tbody');
    Route::get('/cambiar-estado/{id}/{estado}', [Usuarios::class, 'estado'])->name('usuarios.estado');
    Route::get('/cambiar-password/{id}/{password}', [Usuarios::class, 'cambio_password'])->name('usuarios.password');
});

Route::prefix('compras')->middleware('auth')->group(function(){
    Route::get('/', [Compras::class, 'index'])->name('compras');
    Route::get('/create/{id_producto}', [Compras::class, 'create'])->name('compras.create');
    Route::post('/store', [Compras::class, 'store'])->name('compras.store');
    Route::get('/edit/{id}', [Compras::class, 'edit'])->name('compras.edit');
    Route::put('/update/{id}', [Compras::class, 'update'])->name('compras.update');
    Route::get('/show/{id}', [Compras::class, 'show'])->name('compras.show');
    Route::delete('/destroy/{id}', [Compras::class, 'destroy'])->name('compras.destroy');
});