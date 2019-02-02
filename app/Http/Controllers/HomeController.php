<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Docente;

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
        return view('home');
    }

    public function docentes(Request $request)
    {
        return view('docentes');
    }

    public function semestre(Request $request, Docente $docente)
    {
        return $docente;
    }

    public function planilha(Request $request)
    {
        return $request;
    }
}
