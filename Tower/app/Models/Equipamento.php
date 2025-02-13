<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipamento extends Model
{
    protected $table = 'equipamento';

    protected $fillable = [
        'ficha_id',
        'nome',
        'quantidade',
        'peso_por_unidade',
    ];

    public function ficha()
    {
        return $this->belongsTo(Ficha::class);
    }
}