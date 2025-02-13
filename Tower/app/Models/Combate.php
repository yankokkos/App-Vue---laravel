<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Combate extends Model
{
    protected $table = 'combate';

    protected $fillable = [
        'ficha_id',
        'pericia',
        'arma_ou_poder',
        'ataque',
        'pts',
        'dano_basico',
        'cargas',
        'ataque_por_turno',
        'distancia',
        'detalhes',
    ];

    public function ficha()
    {
        return $this->belongsTo(Ficha::class);
    }
}