<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Venta;
use Illuminate\Http\Request;

class Dashboard extends Controller
{
    public function index(){
        $titulo = 'Dashboard';
        $totalVentas = Venta::sum('total_venta');
        $cantidadVentas = Venta::count();
        $productosBajosStock = Producto::where('cantidad', '<', 5)->get();
        $ventasRecientes = Venta::orderBy('created_at', 'desc')->take(5)->get();
        return view('modules.dashboard.home', compact('titulo', 'totalVentas', 'cantidadVentas', 'productosBajosStock', 'ventasRecientes'));
    }
}
