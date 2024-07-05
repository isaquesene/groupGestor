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
use Filament\Notifications\Notification;

class Unitlw extends Component implements HasTable, HasForms
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
                        ->form(UnitForm::schema())
                        ->action(function ($record, $data) {
                            $record->update($data);
                            $this->notify('Unidade atualizada com sucesso.');
                        }),
                    Tables\Actions\DeleteAction::make()
                        ->action(function ($record) {
                            try {
                                $record->delete();
                                $this->notify('Unidade deletada com sucesso.');
                            } catch (\Exception $e) {
                                $this->notify('Erro ao deletar unidade: ' . $e->getMessage(), 'error');
                            }
                        }),
                ])
                ->button()
                ->label('Ações')
            ])
            ->bulkActions([
                ExportBulkAction::make(),
                Tables\Actions\DeleteBulkAction::make()
                    ->action(function ($records) {
                        try {
                            $records->each->delete();
                            $this->notify('Unidades deletadas com sucesso.');
                        } catch (\Exception $e) {
                            $this->notify('Erro ao deletar unidades: ' . $e->getMessage(), 'error');
                        }
                    }),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label('Criar Unidade')
                    ->model(Unit::class)
                    ->form(UnitForm::schema())
                    ->action(function ($data) {
                        Unit::create($data);
                        $this->notify('Unidade criada com sucesso.');
                    })
           ]);
   }
}
