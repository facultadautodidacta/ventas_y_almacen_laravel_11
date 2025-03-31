<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class Ventas extends Controller
{
    public function index(){
        $titulo = 'Ventas';
        $items = Producto::all();
        return view('modules.ventas.index', compact('titulo', 'items'));
    }

    public function agregar_carrito($id_producto) {
        $item = Producto::find($id_producto);
        $cantidad_disponible = $item->cantidad;
        //Obtener los productos ya almacenados
        $items_carrito = Session::get('items_carrito', []);
        $existe_producto = false;
        foreach($items_carrito as $key => $carrito) {
            if ($carrito['id'] == $id_producto) {
                if($carrito['cantidad'] >= $cantidad_disponible) {
                    return to_route('ventas-nueva')->with('error', 'No hay stock suficiente!!!');
                }
                $items_carrito[$key]['cantidad'] += 1;
                $existe_producto = true;
                break;
            }
        }
        //agregar el nuevo producto
        if (!$existe_producto) {
            $items_carrito [] = [
                'id' => $item->id,
                'codigo' => $item->codigo,
                'nombre' => $item->nombre,
                'cantidad' => 1,
                'precio' => $item->precio_venta
            ];
        }
        //realmente creamos una sesion
        Session::put('items_carrito', $items_carrito);
        return to_route('ventas-nueva');
    }

    public function quitar_carrito($id_producto) {
        $items_carrito = Session::get('items_carrito', []);

        foreach($items_carrito as $key => $carrito) {
            if ($carrito['id'] == $id_producto) {
                if ($carrito['cantidad'] > 1) {
                    $items_carrito[$key]['cantidad'] -= 1;
                } else {
                    unset($items_carrito[$key]);
                }
                break;
            }
        }
        Session::put('items_carrito', $items_carrito);
        return to_route('ventas-nueva');
    }

    public function borrar_carrito(){
        Session::forget('items_carrito');
        return to_route('ventas-nueva');
    }
}
