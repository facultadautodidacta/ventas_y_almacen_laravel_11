<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class Reportes_productos extends Controller
{
    public function index()
    {
        $titulo = "Reportes de productos";
        $items = Producto::select(
            'productos.*',
            'categorias.nombre as nombre_categoria',
            'proveedores.nombre as nombre_proveedor',
            'imagenes.ruta as imagen_producto',
            'imagenes.id as imagen_id' 
        )
        ->join('categorias', 'productos.categoria_id', '=' , 'categorias.id')
        ->join('proveedores', 'productos.proveedor_id', '=' , 'proveedores.id')
        ->leftJoin('imagenes', 'productos.id', '=', 'imagenes.producto_id')
        ->get();

        return view('modules.reportes_productos.index', compact('titulo', 'items'));
    }

    public function falta_stock(){
        $titulo = "Falta Stock";
        $items = Producto::select(
            'productos.*',
            'categorias.nombre as nombre_categoria',
            'proveedores.nombre as nombre_proveedor',
            'imagenes.ruta as imagen_producto',
            'imagenes.id as imagen_id' 
        )
        ->join('categorias', 'productos.categoria_id', '=' , 'categorias.id')
        ->join('proveedores', 'productos.proveedor_id', '=' , 'proveedores.id')
        ->leftJoin('imagenes', 'productos.id', '=', 'imagenes.producto_id')
        ->whereBetween('productos.cantidad', [0,1])
        ->get();

        return view('modules.reportes_productos.falta_stock', compact('titulo', 'items'));
    }
}
