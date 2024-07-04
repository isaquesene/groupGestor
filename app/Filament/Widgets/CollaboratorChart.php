<?php

namespace App\Filament\Widgets;

use App\Models\Collaborator;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class CollaboratorChart extends ChartWidget
{

    protected static ?int $sort = 2;

    protected static ?string $heading = 'Total Colaboradores';

    protected function getData(): array
    {
        /*
        $data = $this->getCollaboratorMonth();

        return [
            // grafico linha de colaboradores 
            'datasets' => [
                [
                    'label' => 'Blog post created',
                    'data' => $data['getCollaborator']
                ]
            ],

            'labels' => $data['months']

        ];
        */

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
                    'label' => 'Colaboradores',
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


    /*
    private function getCollaboratorMonth()
    {
        $now = Carbon::now();

        $getCollaborator = [];

        $months = collect(range(1, 12))->map(function($month) use ($now, $getCollaborator){
            $count = Collaborator::whereMonth('created_at', Carbon::parse($now->month($month)
                ->format('Y-m')))->count(); 

                $getCollaborator[] = $count;

                return $now->month($month)->format('M');
        })->toArray();

        return [
            'getCollaborator' => $getCollaborator,
            'months' => $months
        ];
    }
    */
}
