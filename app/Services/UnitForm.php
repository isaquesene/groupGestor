<?php

namespace App\Services;

use App\Models\Flag;
use Filament\Forms;
use Filament\Support\RawJs;

//composer require laravellegends/pt-br-validator

final class UnitForm
{
    public static function schema(): array
    {
        return [
            Forms\Components\TextInput::make('nome_fantasia')
                ->label('Nome Fantasia')
                ->placeholder('Digite aqui...')
                ->required()
                ->maxLength(255),
            Forms\Components\TextInput::make('razao_social')
                ->label('Razão Social')
                ->placeholder('Digite aqui...')
                ->required()
                ->maxLength(255),
            Forms\Components\TextInput::make('cnpj')
                ->mask(RawJs::make(<<<'JS'
                    $input.length > 14 ? '99.999.999/9999-99' : '999.999.999-99'
                JS))
                ->rule('cpf_ou_cnpj')
                ->placeholder('99.999.999/9999-99'),
            Forms\Components\Select::make('flag_id')
                ->label('Bandeira')
                ->searchable()
                ->options(Flag::pluck('nome', 'id')->toArray())
                ->native(false)
                ->placeholder('Selecione...')
                ->required(),
        ];
    }
}