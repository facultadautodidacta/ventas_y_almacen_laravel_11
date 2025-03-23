<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Compras extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $titulo = 'Comprar productos';
        $item = Producto::find($id);
        return view('modules.compras.create', compact('titulo', 'item'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $item = new Compra();
            $item->user_id = Auth::user()->id;
            $item->producto_id = $request->id;
            $item->cantidad = $request->cantidad;
            $item->precio_compra = $request->precio_compra;
            if ($item->save()) {
                $item = Producto::find($request->id);
                $item->cantidad = ($item->cantidad + $request->cantidad);
                $item->precio_compra = $request->precio_compra;
                $item->save();
            }
            return to_route('productos')->with('success', 'Compra exitosa!');
        } catch (\Throwable $th) {
            return to_route('productos')->with('error', 'No pudo comprar!' . $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
