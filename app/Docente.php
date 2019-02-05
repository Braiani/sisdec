<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Docente extends Model
{
    protected $fillable = ['nome', 'siape', 'email'];

    public function disciplinas()
    {
        return $this->belongsToMany(Disciplina::class)->withPivot('semestre');
    }
}
