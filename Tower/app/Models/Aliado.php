<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aliado extends Model
{
    protected $table = 'aliados';

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