<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mob extends Model
{
    protected $table = 'mobs';

    protected $fillable = [
        'nome',
        'imagem',
        'pvs_atual',
        'pss_atual',
        'pes_atual',
    ];
}