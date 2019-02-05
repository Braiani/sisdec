<?php

namespace App\Http\Controllers;

use App\Curso;
use App\Disciplina;
use App\Docente;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use League\Csv\Reader;

class DisciplinaController extends Controller
{

    /**
     * DisciplinaController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function atualizar(Request $request)
    {
        $request->validate([
            'arquivo' => 'required|file'
        ]);

        try{
            $csv = Reader::createFromPath($request->arquivo);
            $csv->setHeaderOffset(0);
            foreach ($csv as $fileLine) {
                $cursoFile = $this->formatCursoName($fileLine['curso']);

                $curso = Curso::firstOrCreate(
                    ['nome' => $cursoFile]
                );

                $disciplina = Disciplina::firstOrCreate(
                    [
                        'nome' => $fileLine['unidade_curricular'],
                        'curso_id' => $curso->id
                    ],
                    [
                        'ch' => (integer) $fileLine['ch']
                    ]
                );

                $semestre = $this->getSemestreFile($fileLine['classe']);

                $docentesFile = explode(',', $fileLine['professores']);

                foreach ($docentesFile as $docenteFile) {
                    $docente = Docente::where('nome', $docenteFile)->firstOrFail();

//                    $docente->disciplinas()->attach($disciplina->id, ['semestre' => "2018.2"]);

                    dump($docente->disciplinas->get('disciplina.nome'));
                    dump($docente->disciplinas->where('pivot.semestre', '2018.2')->count() === 0);
                }

                dd($disciplina->nome);

            }
        }catch (ModelNotFoundException $exception){
            toastr()->error($exception->getMessage());
        }finally{
//            return redirect()->route('home');
        }
    }

    public function getSemestreFile($origem)
    {
        $response = Str::substr($origem, 0, 4) . '.' . Str::substr($origem, 4, 1);
        return $response;
    }

    private function formatCursoName($origem) : string
    {
        $response = str_replace('Curso ', '', $origem);
        $response = str_replace(' - Integrado', '', $response);

        return $response;
    }
}
