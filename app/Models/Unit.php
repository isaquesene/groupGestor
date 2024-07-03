<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;

    protected $table = 'units';

    protected $fillable = [
        'nome_fantasia',
        'razao_social',
        'cnpj',
        'flag_id'
    ];

    public function flag()
    {
        return $this->belongsTo(Flag::class, 'flag_id');
    }
}
