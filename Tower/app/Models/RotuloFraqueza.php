<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RotuloFraqueza extends Model
{
    protected $table = 'rotulos_fraqueza';

    protected $fillable = [
        'tema_id',
        'nome',
        'nivel',
        'efeito',
    ];

    public function tema()
    {
        return $this->belongsTo(TemaDePoder::class, 'tema_id');
    }
}