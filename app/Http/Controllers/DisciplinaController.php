<?php

namespace App\Http\Controllers;

use App\Curso;
use App\Disciplina;
use App\Docente;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
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

        $namesError = [];

        $csv = Reader::createFromPath($request->arquivo);
        $csv->setHeaderOffset(0);
        foreach ($csv as $fileLine) {
            $cursoFile = $fileLine['curso'];

            $curso = Curso::firstOrCreate(
                ['nome' => $cursoFile]
            );

            $disciplina = Disciplina::firstOrCreate(
                [
                    'nome' => $fileLine['unidade_curricular'],
                    'curso_id' => $curso->id
                ],
                [
                    'ch' => (integer)$fileLine['ch']
                ]
            );

            $semestre = $this->getSemestreFromFile($fileLine['periodo']);

            $docentesFile = explode(',', $fileLine['professores']);

            foreach ($docentesFile as $docenteFile) {
                try {
                    $docenteFile = trim($docenteFile);
                    $docente = Docente::where('nome', 'LIKE', "{$docenteFile}%")->firstOrFail();

                    $docenteDisciplinas = $docente->disciplinas->where('pivot.semestre', $semestre)->where('id', $disciplina->id);

                    if ($docenteDisciplinas->isEmpty()) {
                        $docente->disciplinas()->attach($disciplina->id, ['semestre' => $semestre]);
                    }
                } catch (ModelNotFoundException $e) {
                    if (!in_array($docenteFile, $namesError)) {
                        array_push($namesError, $docenteFile);
                        toastr()->error('Docente ' . $docenteFile . ' não cadastrado');
                    }
                }
            }

        }
        toastr()->success('Disciplinas cadastradas');
        return redirect()->route('home');
    }

    public function getSemestreFromFile($origem)
    {
        $response = str_replace('/', '.', $origem);
        return $response;
    }
}
