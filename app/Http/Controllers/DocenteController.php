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

        return view('docentes.index')->with(['docentes' => $docentes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('docentes.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'nome' => 'required',
            'email' => 'required|email',
            'siape' => 'required'
        ]);

        if (Docente::where('siape', $validate['siape'])->count() > 0){
            return redirect()->back()->withInput()->withErrors('Já existe um docente cadastrado com esse SIAPE');
        }

        Docente::create($validate);
        toastr()->success('Docente cadastrado com sucesso!');
        return redirect()->route('sisdec.docente.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Docente $docente
     * @return \Illuminate\Http\Response
     */
    public function edit(Docente $docente)
    {
        return view('docentes.edit')->with(['docente' => $docente]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Docente $docente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Docente $docente)
    {
        $validate = $request->validate([
            'nome' => 'required',
            'email' => 'required|email',
            'siape' => 'required'
        ]);

        $docente->update($validate);
        toastr()->success('Docente cadastrado com sucesso!');
        return redirect()->route('sisdec.docente.index');
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

    public function declaracao(Request $request)
    {
        $request->validate([
            'docente' => 'required|integer'
        ]);

        if ($request->docente == '-1') {
            $docentes = Docente::has('disciplinas')->get();
            foreach ($docentes as $docente) {
                set_time_limit(60);
                $pdf = PDF::loadView('declaracao.declaracao', ['docente' => $docente]);
                $filename = public_path() . '/teste/' . $docente->nome . '.pdf';
                $pdf->save($filename);
            }
            toastr()->success('PDFs gerado com sucesso!');
            return redirect()->route('sisdec.docente.index');
        } else {
            $docente = Docente::where('id', $request->docente)->first();
            /*$teste = $docente->disciplinas->whereBetween('pivot.semestre', ['2015', '2018.2'])->min('pivot.semestre');
            dd($teste);*/
            $pdf = PDF::loadView('declaracao.declaracao', ['docente' => $docente]);
            return $pdf->stream($docente->nome . '.pdf');
            /*return view('declaracao.declaracao')->with(['docente' => $docente]);*/
        }
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
