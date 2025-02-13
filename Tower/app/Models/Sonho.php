<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sonho extends Model
{
    protected $table = 'sonhos';

    protected $fillable = [
        'ficha_id',
        'sonho',
    ];

    public function ficha()
    {
        return $this->belongsTo(Ficha::class);
    }
}