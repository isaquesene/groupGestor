<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class EconomicGroupLw extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-briefcase';

    protected static string $view = 'filament.pages.economic-group-lw';

    protected static ?string $navigationLabel = 'Grupo Econômico';

    protected ?string $heading = 'Grupo Econômico';

    protected static ?string $navigationGroup = 'Funcionalidades';
}
