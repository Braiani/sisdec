<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Disciplina extends Model
{
    protected $fillable = ['nome', 'ch', 'curso_id'];

    public function curso()
    {
        return $this->belongsTo(Curso::class);
    }
}
