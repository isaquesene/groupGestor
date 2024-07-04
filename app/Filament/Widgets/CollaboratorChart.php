<?php

namespace App\Filament\Widgets;

use App\Models\Collaborator;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class CollaboratorChart extends ChartWidget
{
    protected static ?string $heading = 'Colaboradores';

    protected static ?int $sort = 2;

    protected function getData(): array
    {

        $data = Trend::model(Collaborator::class)
            ->between(
                start: now()->startOfYear(),
                end: now()->endOfYear(),
            )
            ->perMonth()
            ->count();
    
        return [
            'datasets' => [
                [
                    'label' => 'Total Colaboradores',
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                ],
            ],
            'labels' => $data->map(fn (TrendValue $value) => $value->date),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
