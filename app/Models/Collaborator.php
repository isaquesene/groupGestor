<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Collaborator extends Model
{
    use HasFactory;

    use LogsActivity;

    protected $table = 'collaborator';

    protected $fillable = [
        'nome',
        'email',
        'cpf',
        'unit_id'
    ];

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['nome', 'email', 'cpf', 'unit.nome_fantasia']); //monitorar alterações do usuário
    }
}
