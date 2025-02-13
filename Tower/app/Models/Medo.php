<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medo extends Model
{
    protected $table = 'medos';

    protected $fillable = [
        'ficha_id',
        'medo',
    ];

    public function ficha()
    {
        return $this->belongsTo(Ficha::class);
    }
}