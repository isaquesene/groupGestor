<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class UserPage extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static string $view = 'filament.pages.user-page';

    protected static ?string $navigationLabel = 'Usuários';

    protected ?string $heading = 'Gerenciar Usuários';
}
