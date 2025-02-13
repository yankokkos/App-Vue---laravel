<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClasseAmeaca extends Model
{
    protected $table = 'classe_ameaca';

    protected $fillable = [
        'classe',
        'poder_inato',
        'facilidade_controle',
        'risco_instabilidade',
        'exemplo',
    ];
}