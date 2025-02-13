<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plano extends Model
{
    protected $table = 'planos';

    protected $fillable = [
        'nome',
        'atributo1',
        'atributo2',
        'atributo3',
        'exemplo_poder',
    ];
}