<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TemaDePoder extends Model
{
    protected $table = 'temas_de_poder';

    protected $fillable = [
        'ficha_id',
        'titulo',
        'tema',
        'descricao',
    ];

    public function ficha()
    {
        return $this->belongsTo(Ficha::class);
    }
}