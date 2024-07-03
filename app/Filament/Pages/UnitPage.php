<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class UnitPage extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-building-office';

    protected static string $view = 'filament.pages.unit-page';

    protected static ?string $navigationLabel = 'Unidade';

    protected ?string $heading = 'Unidade';
}
