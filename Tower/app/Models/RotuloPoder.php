<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RotuloPoder extends Model
{
    protected $table = 'rotulos_poder';

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