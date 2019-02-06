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
                    'ch' => (integer)$fileLine['ch']
                ]
            );

            $semestre = $this->getSemestreFromFile($fileLine['classe']);

            $docentesFile = explode(',', $fileLine['professores']);

            foreach ($docentesFile as $docenteFile) {
                try {
                    $docente = Docente::where('nome', $docenteFile)->firstOrFail();

                    $docenteDisciplinas = $docente->disciplinas->where('pivot.semestre', $semestre)->where('id', $disciplina->id);

                    if ($docenteDisciplinas->isEmpty()) {
                        $docente->disciplinas()->attach($disciplina->id, ['semestre' => $semestre]);
                    }
                } catch (ModelNotFoundException $e) {
                    toastr()->error('Docente ' . $docenteFile . ' não cadastrado');
                }
            }

        }
        toastr()->success('Disciplinas cadastradas');
        return redirect()->route('home');
    }

    public function getSemestreFromFile($origem)
    {
        $response = Str::substr($origem, 0, 4) . '.' . Str::substr($origem, 4, 1);
        return $response;
    }

    private function formatCursoName($origem): string
    {
        $response = str_replace('Curso ', '', $origem);
        $response = str_replace(' - Integrado', '', $response);

        return $response;
    }
}
