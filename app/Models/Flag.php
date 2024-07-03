<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flag extends Model
{
    use HasFactory;

    protected $table = 'flag';

    protected $fillable = [
        'nome',
        'grupo_economico_id'
    ];

    public function economicGroup()
    {
        return $this->belongsTo(EconomicGroup::class, 'grupo_economico_id');
    }
}
