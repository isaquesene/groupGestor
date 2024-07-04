<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class FlagPage extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-flag';

    protected static string $view = 'filament.pages.flag-page';

    protected static ?string $navigationLabel = 'Bandeira';

    protected ?string $heading = 'Bandeira';

    protected static ?string $navigationGroup = 'Funcionalidades';
}
