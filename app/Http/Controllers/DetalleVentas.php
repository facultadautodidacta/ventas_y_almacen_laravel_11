<?php

namespace App\Http\Controllers;

use App\Models\Detalle_venta;
use App\Models\Producto;
use App\Models\Venta;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function revocar($id) {
        DB::beginTransaction();
        try {

            $detalles = Detalle_venta::select(
                'producto_id', 'cantidad'
            )
            ->where('venta_id', $id)
            ->get();

            //devolver stock
            foreach($detalles as $detalle) {
                Producto::where('id', $detalle->producto_id)
                ->increment('cantidad', $detalle->cantidad);
            }

            //eliminar productos vendidos y la venta
            Detalle_venta::where('venta_id', $id)->delete();
            Venta::where('id', $id)->delete();

            DB::commit();
            return to_route('detalle-venta')->with('success', 'Revocacion de venta exitosa!!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return to_route('detalle-venta')->with('error', 'RNo se pudo revocar la venta!!');
        }
    }

    public function generarTicket($id)
{
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

    // Generar PDF con tamaño personalizado tipo ticket (80mm x altura ajustable)
    $pdf = Pdf::loadView('modules.detalles_ventas.ticket', compact('venta', 'detalles'))
              ->setPaper([0, 0, 300, 900], 'portrait'); // 80mm de ancho

    return $pdf->stream("ticket_compra_{$venta->id}.pdf");
}

}
