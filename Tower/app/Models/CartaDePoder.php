<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartaDePoder extends Model
{
    protected $table = 'cartas_de_poder';

    protected $fillable = [
        'titulo',
        'gasto_pe',
        'tempo',
        'descricao',
        'efeitos_basicos',
        'efeitos_adicionais',
        'ficha_id',
    ];

    public function ficha()
    {
        return $this->belongsTo(Ficha::class);
    }
}