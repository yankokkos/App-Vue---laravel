<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoSeed extends Model
{
    protected $table = 'tipos_seed';

    protected $fillable = [
        'nome',
        'cartas_de_poder',
        'custo_pe',
        'facilidade_controle',
        'poder_inato',
    ];
}