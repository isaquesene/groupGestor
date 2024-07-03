<?php

namespace App\Services;

use App\Models\Collaborator;
use App\Models\Unit;
use Filament\Forms;
use Filament\Support\RawJs;

//composer require laravellegends/pt-br-validator

final class CollaboratorForm
{
    public static function schema(): array
    {
        return [
            Forms\Components\Grid::make(2)
                ->schema([
                    Forms\Components\TextInput::make('nome')
                        ->label('Nome Completo')
                        ->placeholder('Digite aqui...')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('email')
                        ->placeholder('Digite aqui...')
                        ->email()
                        ->required()
                        ->unique(ignoreRecord: true)
                        ->maxLength(255),
                    Forms\Components\TextInput::make('cpf')
                        ->mask('999.999.999-99')
                        ->placeholder('999.999.999-99')
                        ->rule('cpf'),
                    Forms\Components\Select::make('unit_id')
                        ->label('Unidade')
                        ->searchable()
                        ->options(Unit::pluck('nome_fantasia', 'id')->toArray())
                        ->native(false)
                        ->placeholder('Selecione...')
                        ->required(),
                ]),
        ];
    }
}