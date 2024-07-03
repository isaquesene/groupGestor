<?php

namespace App\Services;

use Filament\Forms;

final class EconomicGroupForm
{
    public static function schema(): array
    {
        return [
            //->icon('heroicon-m-wrench')
            Forms\Components\TextInput::make('nome')
                ->label('Nome do Grupo')
                ->placeholder('Digite aqui...')
                ->required()
                ->maxLength(255),
        ];
    }
}