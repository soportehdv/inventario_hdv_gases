<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Auth::user()->rol = 'inventario')
            return redirect()->route('productos.lista');
        else 
            if(Auth::user()->rol = 'ventas')
                return redirect()->route('ventas.lista');
            else
                return redirect()->route('user.lista');
    }
}
