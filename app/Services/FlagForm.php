<?php

namespace App\Services;

use App\Models\EconomicGroup;
use Filament\Forms;

final class FlagForm
{
    public static function schema(): array
    {
        return [
            Forms\Components\TextInput::make('nome')
                ->label('Nome da Bandeira')
                ->placeholder('Digite aqui...')
                ->required()
                ->maxLength(255),
            Forms\Components\Select::make('grupo_economico_id')
                ->label('Grupo Econômico')
                ->searchable()
                ->options(EconomicGroup::pluck('nome', 'id')->toArray())
                ->native(false)
                ->placeholder('Selecione...')
                ->required(),
        ];
    }
}