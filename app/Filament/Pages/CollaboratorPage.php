<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class CollaboratorPage extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static string $view = 'filament.pages.collaborator-page';

    protected static ?string $navigationLabel = 'Colaborador';

    protected ?string $heading = 'Gerenciar Colaboradores';

    protected static ?string $navigationGroup = 'Funcionalidades';
}
