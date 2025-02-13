<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pericia extends Model
{
    protected $table = 'pericias';

    protected $fillable = [
        'ficha_id',
        'nome',
        'nivel_pericia',
        'bonus',
        'nivel_disponivel',
        'formula',
    ];

    public function ficha()
    {
        return $this->belongsTo(Ficha::class);
    }
}