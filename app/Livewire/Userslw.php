<?php

namespace App\Livewire;

use App\Models\User;
use App\Services\UserForm;
use Livewire\Component;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Forms;
use Filament\Tables\Actions\ActionGroup;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use Filament\Notifications\Notification;

class Userslw extends Component implements HasTable, HasForms
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
        return view('livewire.userslw');
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(User::query())
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nome Completo')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('E-mail')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\ToggleColumn::make('active')
                    ->label('Ativo'),
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
                        ->form(UserForm::schema()),
                    Tables\Actions\EditAction::make()
                        ->form(UserForm::schema())
                        ->action(function ($record, $data) {
                            $record->update($data);
                            $this->notify('Usuário atualizado com sucesso.');
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
                    ->label('Criar Usuário')
                    ->model(User::class)
                    ->form(UserForm::schema())
                    ->action(function ($data) {
                        User::create($data);
                        $this->notify('Usuário criado com sucesso.');
                    })
            ]);
    }
}
