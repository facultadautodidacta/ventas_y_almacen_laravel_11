<?php

namespace App\Http\Controllers;

use App\Models\Detalle_venta;
use App\Models\Venta;
use Illuminate\Http\Request;

class DetalleVentas extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
        $titulo = 'Detalles de ventas';
        $items = Venta::select(
            'ventas.*',
            'users.name as nombre_usuario'
        )
        ->join('users', 'ventas.user_id', '=', 'users.id')
        ->orderBy('ventas.created_at', 'desc')
        ->get();

        return view('modules.detalles_ventas.index', compact('titulo','items'));
    }

    public function vista_detalle($id){
        $titulo = 'Detalle de venta';
        $venta = Venta::select(
            'ventas.*',
            'users.name as nombre_usuario'
        )
        ->join('users', 'ventas.user_id', '=', 'users.id')
        ->where('ventas.id', $id)
        ->firstOrFail();

        $detalles = Detalle_venta::select(
            'detalle_venta.*',
            'productos.nombre as nombre_producto'
        )
        ->join('productos', 'detalle_venta.producto_id', '=', 'productos.id')
        ->where('venta_id', $id)
        ->get();

        return view('modules.detalles_ventas.detalle_venta', compact('titulo', 'venta', 'detalles'));
    }
}
