<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HabilidadeEspecial extends Model
{
    protected $table = 'habilidades_especiais';

    protected $fillable = [
        'ficha_id',
        'habilidade',
        'nivel',
        'descricao',
    ];

    public function ficha()
    {
        return $this->belongsTo(Ficha::class);
    }
}