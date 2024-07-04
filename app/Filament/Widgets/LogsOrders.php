<?php

namespace App\Filament\Widgets;

use App\Models\Activity_log;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Spatie\Activitylog\Models\Activity;
use Rmsramos\Activitylog\Resources\ActivitylogResource;
use Illuminate\Support\Str;
use Livewire\Component as Livewire;
use Illuminate\Database\Eloquent\Model;
use Rmsramos\Activitylog\RelationManagers\ActivitylogRelationManager;
use Illuminate\Support\HtmlString;
use Filament\Tables\Columns\Column;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ViewColumn;


class LogsOrders extends BaseWidget
{

    protected static ?int $sort = 3;

    public function table(Table $table): Table
    {
        return $table
            //->query(Activity_log::getEloquentQuery())
            ->query(
                Activity::query()
                //->defaultPaginationPageOption(5)
                ->orderBy('created_at', 'desc')
            )
            ->columns([
                Tables\Columns\TextColumn::make('log_name')
                    ->label(__('activitylog::tables.columns.log_name.label'))
                    ->badge()
                    ->formatStateUsing(fn ($state) => ucwords($state))
                    ->sortable(),
                Tables\Columns\TextColumn::make('event')
                    ->label(__('activitylog::tables.columns.event.label'))
                    ->formatStateUsing(fn ($state) => ucwords($state))
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'draft'   => 'gray',
                        'updated' => 'warning',
                        'created' => 'success',
                        'deleted' => 'danger',
                        default   => 'primary',
                    })
                    ->sortable(),
                Tables\Columns\TextColumn::make('subject_type')
                    ->label(__('activitylog::tables.columns.subject_type.label'))
                    ->formatStateUsing(function ($state, Model $record) {
                        /** @var Activity&ActivityModel $record */
                        if (! $state) {
                            return '-';
                        }

                        return Str::of($state)->afterLast('\\')->headline() . ' # ' . $record->subject_id;
                    })
                    ->hidden(fn (Livewire $livewire) => $livewire instanceof ActivitylogRelationManager),
                Tables\Columns\TextColumn::make('causer.name')
                    ->label(__('User'))
                    ->getStateUsing(function (Model $record) {

                        if ($record->causer_id == null) {
                            return new HtmlString('&mdash;');
                        }

                        return $record->causer->name;
                    })
                    ->searchable(),
                static::getPropertiesColumnCompoment(),
            ]);
    }

    public static function getPropertiesColumnCompoment(): Column
    {
        return ViewColumn::make('properties')
            ->label(__('activitylog::tables.columns.properties.label'))
            ->view('activitylog::filament.tables.columns.activity-logs-properties')
            ->toggleable(isToggledHiddenByDefault: true);
    }

}
