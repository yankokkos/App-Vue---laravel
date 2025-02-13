<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inimigo extends Model
{
    protected $table = 'inimigos';

    protected $fillable = [
        'ficha_id',
        'nome',
        'relacao',
    ];

    public function ficha()
    {
        return $this->belongsTo(Ficha::class);
    }
}