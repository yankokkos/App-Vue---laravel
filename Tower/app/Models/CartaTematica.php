<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartaTematica extends Model
{
    protected $table = 'cartas_tematicas';

    protected $fillable = [
        'carta_id',
        'tema_id',
    ];

    public function carta()
    {
        return $this->belongsTo(CartaDePoder::class, 'carta_id');
    }

    public function tema()
    {
        return $this->belongsTo(TemaDePoder::class, 'tema_id');
    }
}