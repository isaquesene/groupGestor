# Group Gestor - Sistema de gestão para grupos econômicos

<div class="filament-hidden">

![Design sem nome (1)](https://github.com/isaquesene/groupGestor/assets/109972304/d7cea22e-0e0b-4eab-9e04-79aba2793437)

</div>

This package provides a Filament resource that shows you all of the activity logs and detailed view of each log created using the `spatie/laravel-activitylog` package. It also provides a relationship manager for related models.

## Configurações

-   Laravel v11
-   Filament v3
-   Livewire 3
-   Vue.js
-   Tailwind
-   Docker Composer
-   WSL Linux
-   Mysql

## Plugins

-   Spatie/Laravel-activitylog v4
-   Excel Export
-   Livewire Componts tables

## Installation

Clonar o projeto do repositorio:

```bash
git clone https://github.com/isaquesene/groupGestor.git my-project
```

Configurar arquivo .nev dependendo se for usar Docker ou Xampp:

```bash
# rodar com xampp
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=groupgestor
DB_USERNAME=root
DB_PASSWORD=

# rodar com Docker
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=groupgestor
DB_USERNAME=sail
DB_PASSWORD=password

```

## Instalar o Docker

Link para baixar o Docker: 

https://docs.docker.com/desktop/install/windows-install/

![docker-app-search](https://github.com/isaquesene/groupGestor/assets/109972304/c4a5dc91-9cdd-4c48-8861-d1bf4d70af06)

## Configurar o Docker

Apos a instalação do Docker será preciso instalar o WSL, um serviço linux para sunbir arquivos .sh e facilitar a configuração do ambiente.
Passos para configurar e subir a aplicação no ambiente Docker usando o WSL do Linux:

Após instalar o Docker va em 

## Instalar o Xampp

Link para baixar o Xampp:

https://www.apachefriends.org/pt_br/index.html

```bash
php artisan migrate
```

You can manually publish the configuration file with:

```bash
php artisan vendor:publish --tag="activitylog-config"
```

This is the contents of the published config file:

```php
return [
    'resources' => [
        'label'                     => 'Activity Log',
        'plural_label'              => 'Activity Logs',
        'navigation_group'          => null,
        'navigation_icon'           => 'heroicon-o-shield-check',
        'navigation_sort'           => null,
        'navigation_count_badge'    => false,
        'resource'                  => \Rmsramos\Activitylog\Resources\ActivitylogResource::class,
    ],
    'datetime_format' => 'd/m/Y H:i:s',
];
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="activitylog-views"
```

## Usage

### Basic Spatie ActivityLog usage

In you `Model` add `Spatie\Activitylog\Traits\LogsActivity` trait, and configure `getActivitylogOption` function

For more configuration, Please review [Spatie Docs](https://spatie.be/docs/laravel-activitylog/v4)

```php
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class NewsItem extends Model
{
    use LogsActivity;

    protected $fillable = ['name', 'text'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly(['name', 'text']);
    }
}
```

## Plugin usage

![Screenshot of Application Feature](https://raw.githubusercontent.com/rmsramos/activitylog/main/arts/resource.png)

In your Panel ServiceProvider `(App\Providers\Filament)` active the plugin

Add the `Rmsramos\Activitylog\ActivitylogPlugin` to your panel config

```php
use Rmsramos\Activitylog\ActivitylogPlugin;

public function panel(Panel $panel): Panel
{
    return $panel
        ->plugins([
            ActivitylogPlugin::make(),
        ]);
}
```

## Customising the ActivitylogResource

You can swap out the `ActivitylogResource` used by updating the `->resource()` value. Use this to create your own `CustomResource` class and extend the original at `\Rmsramos\Activitylog\Resources\ActivitylogResource::class`. This will allow you to customise everything such as the views, table, form and permissions.

> [!NOTE]
> If you wish to change the resource on List and View page be sure to replace the `getPages` method on the new resource and create your own version of the `ListPage` and `ViewPage` classes to reference the custom `CustomResource`.

```php
use Rmsramos\Activitylog\ActivitylogPlugin;

public function panel(Panel $panel): Panel
{
    return $panel
        ->plugins([
            ActivitylogPlugin::make()
                ->resource(\Path\For\Your\CustomResource::class),
        ]);
}
```

## Customising label Resource

You can swap out the `Resource label` used by updating the `->label()` and `->pluralLabel()` value.

```php
use Rmsramos\Activitylog\ActivitylogPlugin;

public function panel(Panel $panel): Panel
{
    return $panel
        ->plugins([
            ActivitylogPlugin::make()
                ->label('Log')
                ->pluralLabel('Logs'),
        ]);
}
```

## Grouping resource navigation items

You can add a `Resource navigation group` updating the `->navigationGroup()` value.

```php
use Rmsramos\Activitylog\ActivitylogPlugin;

public function panel(Panel $panel): Panel
{
    return $panel
        ->plugins([
            ActivitylogPlugin::make()
                ->navigationGroup('Activity Log'),
        ]);
}
```

## Customising a resource navigation icon

You can swap out the `Resource navigation icon` used by updating the `->navigationIcon()` value.

```php
use Rmsramos\Activitylog\ActivitylogPlugin;

public function panel(Panel $panel): Panel
{
    return $panel
        ->plugins([
            ActivitylogPlugin::make()
                ->navigationIcon('heroicon-o-shield-check'),
        ]);
}
```

## Active a count badge

You can active `Count Badge` updating the `->navigationCountBadge()` value.

```php
use Rmsramos\Activitylog\ActivitylogPlugin;

public function panel(Panel $panel): Panel
{
    return $panel
        ->plugins([
            ActivitylogPlugin::make()
                ->navigationCountBadge(true),
        ]);
}
```

## Set navigation sort

You can set the `Resource navigation sort` used by updating the `->navigationSort()` value.

```php
use Rmsramos\Activitylog\ActivitylogPlugin;

public function panel(Panel $panel): Panel
{
    return $panel
        ->plugins([
            ActivitylogPlugin::make()
                ->navigationSort(3),
        ]);
}
```

## Authorization

If you would like to prevent certain users from accessing the logs resource, you should add a authorize callback in the `ActivitylogPlugin` chain.

```php
use Rmsramos\Activitylog\ActivitylogPlugin;

public function panel(Panel $panel): Panel
{
    return $panel
        ->plugins([
            ActivitylogPlugin::make()
                ->authorize(
                    fn () => auth()->user()->id === 1
                ),
        ]);
}
```

### Role Policy

To ensure ActivitylogResource access via RolePolicy you would need to add the following to your AppServiceProvider:

```php
use App\Policies\ActivityPolicy;
use Illuminate\Support\Facades\Gate;
use Spatie\Activitylog\Models\Activity;

class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Gate::policy(Activity::class, ActivityPolicy::class);
    }
}
```

## Full configuration

```php
use Rmsramos\Activitylog\ActivitylogPlugin;

public function panel(Panel $panel): Panel
{
    return $panel
        ->plugins([
            ActivitylogPlugin::make()
                ->resource(\Path\For\Your\CustomResource::class)
                ->label('Log')
                ->pluralLabel('Logs')
                ->navigationGroup('Activity Log')
                ->navigationIcon('heroicon-o-shield-check')
                ->navigationCountBadge(true)
                ->navigationSort(2)
                ->authorize(
                    fn () => auth()->user()->id === 1
                ),
        ]);
}
```

## Relationship manager

If you have a model that uses the `Spatie\Activitylog\Traits\LogsActivity` trait, you can add the `Rmsramos\Activitylog\RelationManagers\ActivitylogRelationManager` relationship manager to your Filament resource to display all of the activity logs that are performed on your model.
![Screenshot of Application Feature](https://raw.githubusercontent.com/rmsramos/activitylog/main/arts/relationManager.png)

```php
use Rmsramos\Activitylog\RelationManagers\ActivitylogRelationManager;

public static function getRelations(): array
{
    return [
        ActivitylogRelationManager::class,
    ];
}
```

## Timeline Action

![Screenshot of Application Feature](https://raw.githubusercontent.com/rmsramos/activitylog/main/arts/timeline.png)

To make viewing activity logs easier, you can use a custom action. In your UserResource in the table function, add the `ActivityLogTimelineAction`.

```php
use Rmsramos\Activitylog\Actions\ActivityLogTimelineAction;

public static function table(Table $table): Table
{
    return $table
        ->actions([
            ActivityLogTimelineAction::make('Activities'),
        ]);
}
```

you can pass a matrix with the relationships, remember to configure your `Models`.

```php
public static function table(Table $table): Table
{
    return $table
        ->actions([
            ActivityLogTimelineAction::make('Activities')
                ->withRelations(['profile', 'address']), //opcional
        ]);
}
```

You can configure the icons and colors, by default the `'heroicon-m-check'` icon and the `'primary'` color are used.

```php
use Rmsramos\Activitylog\Actions\ActivityLogTimelineAction;

public static function table(Table $table): Table
{
    return $table
        ->actions([
            ActivityLogTimelineAction::make('Activities')
                ->timelineIcons([
                    'created' => 'heroicon-m-check-badge',
                    'updated' => 'heroicon-m-pencil-square',
                ])
                ->timelineIconColors([
                    'created' => 'info',
                    'updated' => 'warning',
                ])
        ]);
}
```

You can limit the number of results in the query by passing a limit, by default the last 10 records are returned.

```php
use Rmsramos\Activitylog\Actions\ActivityLogTimelineAction;

public static function table(Table $table): Table
{
    return $table
        ->actions([
            ActivityLogTimelineAction::make('Activities')
                ->limit(30),
        ]);
}
```

## Full Timeline configuration

```php
use Rmsramos\Activitylog\Actions\ActivityLogTimelineAction;

public static function table(Table $table): Table
{
    return $table
        ->actions([
            ActivityLogTimelineAction::make('Activities')
                ->withRelations(['profile', 'address'])
                ->timelineIcons([
                    'created' => 'heroicon-m-check-badge',
                    'updated' => 'heroicon-m-pencil-square',
                ])
                ->timelineIconColors([
                    'created' => 'info',
                    'updated' => 'warning',
                ])
                ->limit(10),
        ]);
}
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Acknowledgements

Special acknowledgment goes to these remarkable tools and people (developers), the Activity Log plugin only exists due to the inspiration and at some point the use of these people's codes.

-   [Jay-Are Ocero](https://github.com/199ocero/activity-timeline)
-   [Alex Justesen](https://github.com/alexjustesen)
-   [z3d0x](https://github.com/z3d0x/filament-logger)
-   [Filament](https://github.com/filamentphp/filament)
-   [Spatie Activitylog Contributors](https://github.com/spatie/laravel-activitylog#credits)

## Credits

-   [Rômulo Ramos](https://github.com/rmsramos)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
