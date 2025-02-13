<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vantagem extends Model
{
    protected $table = 'vantagens';

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