<?php

namespace App\Livewire;

use App\Models\EconomicGroup;
use App\Services\EconomicGroupForm;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Forms;
use Livewire\Component;
use Filament\Tables\Actions\ActionGroup;
use Filament\Panel;

class EconomicGrouplw extends Component implements HasTable, HasForms
{

    use InteractsWithTable, InteractsWithForms;

    public function render()
    {
        return view('livewire.economic-grouplw');
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(EconomicGroup::query())
            ->columns([
                Tables\Columns\TextColumn::make('nome')
                    ->label('Grupo')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Data de Criação')
                    ->datetime('d/m/Y H:i:s')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Ultima Atualização')
                    ->datetime('d/m/Y H:i:s')
                    ->sortable()
                    ->searchable(),
            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make()
                        //->slideOver()
                        ->form(EconomicGroupForm::schema()),
                    Tables\Actions\DeleteAction::make(),
                ])
                ->button()
                ->label('Ações')
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                ->label('Criar grupo')
                //->slideOver()
                ->model(EconomicGroup::class)
                ->form(EconomicGroupForm::schema())
            ]);
    }
}
