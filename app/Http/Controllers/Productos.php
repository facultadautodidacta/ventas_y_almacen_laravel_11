<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use App\Models\Proveedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Productos extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $titulo = "Productos";
        $items = Producto::select(
            'productos.*',
            'categorias.nombre as nombre_categoria',
            'proveedores.nombre as nombre_proveedor'
        )
        ->join('categorias', 'productos.categoria_id', '=' , 'categorias.id')
        ->join('proveedores', 'productos.proveedor_id', '=' , 'proveedores.id')
        ->get();

        return view('modules.productos.index', compact('titulo', 'items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $titulo = "Crear producto";
        $categorias = Categoria::all();
        $proveedores = Proveedor::all();
        return view('modules.productos.create', compact('titulo', 'categorias', 'proveedores'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $item = new Producto();
            $item->user_id = Auth::user()->id;
            $item->categoria_id = $request->categoria_id;
            $item->proveedor_id = $request->proveedor_id;
            $item->nombre = $request->nombre;
            $item->descripcion = $request->descripcion;
            $item->save();
            return to_route('productos')->with('success', 'Producto creado exitosamente!!');
        } catch (\Throwable $th) {
            return to_route('productos')->with('error', 'Fallo al crear producto!' . $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $titulo = 'Eliminar producto';
        $items = Producto::select(
            'productos.*',
            'categorias.nombre as nombre_categoria',
            'proveedores.nombre as nombre_proveedor'
        )
        ->join('categorias', 'productos.categoria_id', '=' , 'categorias.id')
        ->join('proveedores', 'productos.proveedor_id', '=' , 'proveedores.id')
        ->where('productos.id', $id)
        ->first();
        return view('modules.productos.show', compact('titulo', 'items'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $titulo = 'Editar producto';
        $categorias = Categoria::all();
        $proveedores = Proveedor::all();
        $item = Producto::find($id);
        return view('modules.productos.edit', compact('titulo', 'item', 'categorias', 'proveedores'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $item = Producto::find($id);
            $item->categoria_id = $request->categoria_id;
            $item->proveedor_id = $request->proveedor_id;
            $item->nombre = $request->nombre;
            $item->descripcion = $request->descripcion;
            $item->precio_venta = $request->precio_venta;
            $item->save();
            return to_route('productos')->with('success', 'Producto actualizado exitosamente!!');
        } catch (\Throwable $th) {
            return to_route('productos')->with('error', 'Fallo al actualizar producto!' . $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $item = Producto::find($id);
            $item->delete();
            return to_route('productos')->with('success', 'Producto eliminado exitosamente!!');
        } catch (\Throwable $th) {
            return to_route('productos')->with('error', 'Fallo al eliminar producto!' . $th->getMessage());
        }
    }
}
