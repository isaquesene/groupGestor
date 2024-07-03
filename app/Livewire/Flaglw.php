<?php

namespace App\Livewire;

use App\Models\Flag;
use App\Services\FlagForm;
use Livewire\Component;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Forms;
use Filament\Tables\Actions\ActionGroup;
use Filament\Panel;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class Flaglw extends Component implements HasTable, HasForms
{

    use InteractsWithTable, InteractsWithForms;

    public function render()
    {
        return view('livewire.flaglw');
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(Flag::query())
            ->columns([
                Tables\Columns\TextColumn::make('nome')
                    ->label('Bandeira')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('economicGroup.nome')
                    ->label('Grupo Econômico')
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
                    Tables\Actions\ViewAction::make()
                        ->form(FlagForm::schema()),
                    Tables\Actions\EditAction::make()
                        //->slideOver()
                        ->form(FlagForm::schema()),
                    Tables\Actions\DeleteAction::make(),
                ])
                ->button()
                ->label('Ações')
            ])
            ->bulkActions([
                ExportBulkAction::make(),
                Tables\Actions\DeleteBulkAction::make(),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                ->label('Criar Bandeira')
                //->slideOver()
                ->model(Flag::class)
                ->form(FlagForm::schema())
            ]);
    }
}
