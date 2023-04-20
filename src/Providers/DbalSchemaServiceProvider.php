<?php

namespace MichelJonkman\DbalSchema\Providers;

use Illuminate\Database\Console\Migrations\MigrateCommand;
use Illuminate\Database\Migrations\Migrator;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use MichelJonkman\DbalSchema\Console\MigrateSchemaCommand;
use MichelJonkman\DbalSchema\Database\ConnectionManager;

class DbalSchemaServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->scoped(ConnectionManager::class);
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                MigrateSchemaCommand::class
            ]);
        }
    }
}
