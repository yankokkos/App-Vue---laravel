<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anotacao extends Model
{
    protected $table = 'anotacoes';

    protected $fillable = [
        'ficha_id',
        'conteudo',
    ];

    public function ficha()
    {
        return $this->belongsTo(Ficha::class);
    }
}