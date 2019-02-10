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

    public function getNomeFormatadoAttribute()
    {
        return ucfirst(mb_strtolower(str_replace('*', '', $this->nome), 'UTF-8'));
    }
}
