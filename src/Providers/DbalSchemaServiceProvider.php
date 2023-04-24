<?php

namespace MichelJonkman\DbalSchema\Providers;

use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Database\Migrations\MigrationCreator;
use Illuminate\Database\Migrations\Migrator;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use MichelJonkman\DbalSchema\Console\MakeSchemaCommand;
use MichelJonkman\DbalSchema\Console\MigrateCommand;
use MichelJonkman\DbalSchema\Console\MigrateSchemaCommand;
use MichelJonkman\DbalSchema\Database\ConnectionManager;
use MichelJonkman\DbalSchema\Database\SchemaCreator;

class DbalSchemaServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public function register(): void
    {
        $this->app->scoped(ConnectionManager::class);
        $this->app->scoped(Migrator::class, function (Application $app) {
            return $app->make('migrator');
        });

        $this->app->singleton(SchemaCreator::class, function ($app) {
            return new SchemaCreator($app['files'], $app->basePath('stubs'));
        });
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                MigrateSchemaCommand::class,
                MigrateCommand::class,
                MakeSchemaCommand::class,
            ]);
        }
    }

    public function provides(): array
    {
        return [
            MigrateCommand::class,
            MigrateSchemaCommand::class,
            MakeSchemaCommand::class,
            ConnectionManager::class,
            Migrator::class
        ];
    }
}
