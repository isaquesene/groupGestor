<?php

namespace App\Livewire;

use App\Models\Unit;
use App\Services\UnitForm;
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

class Unitlw extends Component implements HasTable, HasForms
{

    use InteractsWithTable, InteractsWithForms;

    public function render()
    {
        return view('livewire.unitlw');
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(Unit::query())
            ->columns([
                Tables\Columns\TextColumn::make('nome_fantasia')
                    ->label('Nome Fantasia')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('razao_social')
                    ->label('Razão Social')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('cnpj')
                    ->label('CNPJ')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('flag.nome')
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
                        ->form(UnitForm::schema()),
                    Tables\Actions\EditAction::make()
                        //->slideOver()
                        ->form(UnitForm::schema()),
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
                ->label('Criar Unidade')
                //->slideOver()
                ->model(Unit::class)
                ->form(UnitForm::schema())
            ]);
    }
}