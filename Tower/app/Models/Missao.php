<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Missao extends Model
{
    protected $table = 'missoes';

    protected $fillable = [
        'ficha_id',
        'descricao',
    ];

    public function ficha()
    {
        return $this->belongsTo(Ficha::class);
    }
}