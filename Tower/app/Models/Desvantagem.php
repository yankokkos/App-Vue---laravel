<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Desvantagem extends Model
{
    protected $table = 'desvantagens';

    protected $fillable = [
        'ficha_id',
        'nome',
        'descricao',
    ];

    public function ficha()
    {
        return $this->belongsTo(Ficha::class);
    }
}