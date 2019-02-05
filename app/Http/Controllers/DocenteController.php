<?php

namespace App\Http\Controllers;

use App\Docente;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use League\Csv\Reader;

class DocenteController extends Controller
{

    public function __construct()
    {
        setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $docentes = Docente::all();
        return view('docentes')->with(['docentes' => $docentes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function declaracao()
    {
        /*$pdf = PDF::loadView('declaracao.declaracao');
        return $pdf->stream('declaracao.pdf');*/
        return view('declaracao.declaracao');
    }

    /**
     * Update Docentes table from a given csv file.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    public function atualizar(Request $request)
    {
        $request->validate([
            'arquivo' => 'required|file'
        ]);

        try{
            $csv = Reader::createFromPath($request->arquivo);
            $csv->setHeaderOffset(0);

            foreach ($csv as $line) {
                if ($line['siape'] != 'NULL'){
                    Docente::updateOrCreate(
                        ['siape' => $line['siape']],
                        [
                            'nome' => $line['nome'],
                            'email' => $line['email'],
                        ]
                    );
                }
            }

            toastr()->success('Lista de docentes atualizada!');
        }catch (ModelNotFoundException $exception){
            toastr()->error($exception->getMessage());
        }finally{
            return redirect()->route('home');
        }
    }
}
