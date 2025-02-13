<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seed extends Model
{
    protected $table = 'seeds';

    protected $fillable = [
        'ficha_id',
        'plano_origem_id',
        'tipo_seed_id',
        'classe_ameaca_id',
        'patrono_item',
    ];

    public function ficha()
    {
        return $this->belongsTo(Ficha::class);
    }

    public function planoOrigem()
    {
        return $this->belongsTo(Plano::class, 'plano_origem_id');
    }

    public function tipoSeed()
    {
        return $this->belongsTo(TipoSeed::class, 'tipo_seed_id');
    }

    public function classeAmeaca()
    {
        return $this->belongsTo(ClasseAmeaca::class, 'classe_ameaca_id');
    }
}