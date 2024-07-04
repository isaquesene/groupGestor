<?php

namespace App\Filament\Widgets;

use App\Models\EconomicGroup;
use App\Models\Flag;
use App\Models\Unit;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?string $pollingInterval = '15s';

    protected static bool $isLazy = true;

    protected function getStats(): array
    {
        return [
            //Cards Dashboard
            Stat::make('Grupo Econômico', EconomicGroup::count())
                ->description('Total grupo registrados')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('primary')
                ->chart([7, 3, 4, 5, 6, 3, 5, 3]),
            Stat::make('Bandeiras', Flag::count())
                ->description('Total bandeiras registradas')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('primary')
                ->chart([7, 3, 4, 5, 6, 3, 5, 3]),
            Stat::make('Unidades', Unit::count())
                ->description('Total unidades registradas')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('primary')
                ->chart([7, 3, 4, 5, 6, 3, 5, 3])
        ];
    }
}
