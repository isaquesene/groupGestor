<?php

namespace App\Livewire;

use App\Models\Collaborator;
use App\Services\CollaboratorForm;
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
use Filament\Notifications\Notification;

class Collaboratorlw extends Component implements HasTable, HasForms
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
        return view('livewire.collaboratorlw');
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(Collaborator::query())
            ->columns([
                Tables\Columns\TextColumn::make('nome')
                    ->label('Nome')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('E-mail')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('cpf')
                    ->label('CPF')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('unit.nome_fantasia')
                    ->label('Unidade')
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
                        ->form(CollaboratorForm::schema()),
                    Tables\Actions\EditAction::make()
                        ->form(CollaboratorForm::schema())
                        ->action(function ($record, $data) {
                            $record->update($data);
                            $this->notify('Colaborador atualizado com sucesso.');
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
                    ->label('Criar Colaborador')
                    ->model(Collaborator::class)
                    ->form(CollaboratorForm::schema())
                    ->action(function ($data) {
                        Collaborator::create($data);
                        $this->notify('Colaborador criado com sucesso.');
                    })
            ]);
    }
}
