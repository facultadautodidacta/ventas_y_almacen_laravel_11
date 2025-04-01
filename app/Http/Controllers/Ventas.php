<?php

namespace App\Http\Controllers;

use App\Models\Detalle_venta;
use App\Models\Producto;
use App\Models\Venta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
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

    public function vender(){
        $items_carrito = Session::get('items_carrito', []);

        //validar si el carrito esta vacio
        if (empty($items_carrito)) {
            return to_route('ventas-nueva')->with('error', 'El carrito esta vacio!!');
        }

        //iniciar la transaccion
        DB::beginTransaction();

        try {
            $totalVenta = 0;
            foreach ($items_carrito as $item) {
                $totalVenta += $item['cantidad'] * $item['precio'];
            }
            //crear la venta
            $venta = new Venta();
            $venta->user_id = Auth::id();
            $venta->total_venta = $totalVenta;
            $venta->save();

            foreach ($items_carrito as $item) {
                $producto = Producto::find($item['id']);
                //verificar si tenemos suficiente stock
                if ($producto->cantidad < $item['cantidad']) {
                    DB::rollBack();
                    return to_route('ventas-nueva')->with('error', 'No hay stock suficiente para ' . $producto->nombre);
                }

                $detalle = new Detalle_venta();
                $detalle->venta_id = $venta->id;
                $detalle->producto_id = $item['id'];
                $detalle->cantidad = $item['cantidad'];
                $detalle->precio_unitario = $item['precio'];
                $detalle->sub_total = $item['cantidad'] * $item['precio'];
                $detalle->save();

                $producto->cantidad -= $item['cantidad'];
                $producto->save();
            }

            Session::forget('items_carrito');
            DB::commit();
            return to_route('ventas-nueva')->with('success', 'Venta realizada con exito!!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return to_route('ventas-nueva')->with('error', 'Error al procesar la venta!!' . $th->getMessage());
        }
    }
}
