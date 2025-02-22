<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index() {
        $titulo = "Login de usuarios";
        return view("modules.auth.login", compact("titulo"));
    }

    public function logear(Request $request) {
        //validar datos de las credenciales
        $credenciales = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        //buscar el email
        $user = User::where('email', $request->email)->first();

        //validar usuario y contraseña
        if(!$user || !Hash::check($request->password, $user->password)){
            return back()->withErrors(['email' => 'Credencial incorrecta!'])->withInput();
        }

        //el usuario este activo
        if (!$user->activo) {
            return back()->withErrors(['email' => 'Tu cuenta esta inactiva!']);
        }

        //crear la sesion de usuario
        Auth::login($user);
        $request->session()->regenerate();

        return to_route('home');
    }

    public function crearAdmin(){
        //crear directamente un admin
        User::create([
            'name' => 'Facultad Autodidacta',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin'),
            'activo' => true,
            'rol' => 'admin'
        ]);

        return "Admin creado con exito!!";
    }

    public function logout() {
        Auth::logout();
        return to_route('login');
    }

}
