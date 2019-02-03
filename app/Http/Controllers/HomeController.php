<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade as PDF;
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
        setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
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

    public function gerar(Request $request)
    {
        return redirect()->route('declaracao');
    }

    public function planilha(Request $request)
    {
        return $request;
    }

    public function declaracao()
    {
        $pdf = PDF::loadView('declaracao.declaracao');
        return $pdf->stream('declaracao.pdf');
        //return view('declaracao.declaracao');
    }
}
