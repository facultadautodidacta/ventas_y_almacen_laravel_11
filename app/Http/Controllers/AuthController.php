<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index() {
        $titulo = "Login de usuarios";
        return view("modules.auth.login", compact("titulo"));
    }
}
