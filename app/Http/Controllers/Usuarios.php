<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class Usuarios extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $titulo = "Usuarios";
        $items = User::all();
        return view('modules.usuarios.index', compact('items','titulo'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $titulo = 'Usuario nuevo';
        return view('modules.usuarios.create', compact('titulo'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'activo' => true,
            'rol' => $request->rol
        ]);

        return to_route('usuarios');
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
        $item = User::find($id);
        $titulo = "Editar usuario";
        return view('modules.usuarios.edit', compact('item', 'titulo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $item = User::find($id);
        $item->name = $request->name;
        $item->email = $request->email;
        $item->rol = $request->rol;
        $item->save();
        return to_route('usuarios');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function tbody(){
        $items = User::all();
        return view('modules.usuarios.tbody', compact('items'));
    }
}
