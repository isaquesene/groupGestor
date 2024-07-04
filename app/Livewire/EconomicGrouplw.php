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
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use Filament\Notifications\Notification;

class EconomicGrouplw extends Component implements HasTable, HasForms
{
    use InteractsWithTable, InteractsWithForms;

    protected function notify($message, $type = 'success')
    {
        $notification = Notification::make()
            ->title($message);

        if ($type === 'success') {
            $notification->success();
        } else if ($type === 'error') {
            $notification->danger();
        }

        $notification->send();
    }

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
                    Tables\Actions\ViewAction::make()
                        ->form(EconomicGroupForm::schema()),
                    Tables\Actions\EditAction::make()
                        ->form(EconomicGroupForm::schema())
                        ->action(function ($record, $data) {
                            $record->update($data);
                            $this->notify('Grupo Econômico atualizado com sucesso.');
                        }),
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
                    ->label('Criar grupo')
                    ->model(EconomicGroup::class)
                    ->form(EconomicGroupForm::schema())
                    ->action(function ($data) {
                        EconomicGroup::create($data);
                        $this->notify('Grupo Econômico criado com sucesso.');
                    })
            ]);
    }
}
