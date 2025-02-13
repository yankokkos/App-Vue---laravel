<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BattleTracker extends Model
{
    protected $table = 'battle_tracker';

    protected $fillable = [
        'participant_id',
        'is_mob',
        'pvs',
        'pss',
        'pes',
        'initiative',
    ];

    public function participant()
    {
        return $this->belongsTo(Ficha::class, 'participant_id');
    }
}