<?php

namespace App\Services;

use App\Models\User;
use Filament\Forms;

final class UserForm
{
    public static function schema(): array
    {
        return [
            Forms\Components\Grid::make(2)
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->placeholder('Digite aqui...')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->placeholder('Digite aqui...')
                    ->email()
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),
                Forms\Components\TextInput::make('password')
                    ->password()
                    ->required(fn(string $operation): bool => $operation === 'create') // obrigatório apenas no form de criação
                    ->dehydrated(fn(?string $state) => filled($state)) // só envia a informação se estiver preenchida
                    ->confirmed() // verifica se os dois campos (password e confirm password) são iguais
                    ->maxLength(255),
                Forms\Components\TextInput::make('password_confirmation')
                    ->password()
                    ->requiredWith(statePaths: 'password')
                    ->dehydrated(condition: false) 
                    ->maxLength(255),
            ]),
        ];
    }
}