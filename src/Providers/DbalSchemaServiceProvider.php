<?php

namespace MichelJonkman\DbalSchema\Providers;

use Illuminate\Database\Console\Migrations\MigrateCommand;
use Illuminate\Support\ServiceProvider;
use MichelJonkman\DbalSchema\Console\MigrateSchemaCommand;
use MichelJonkman\DbalSchema\Database\ConnectionManager;

class DbalSchemaServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->scoped(ConnectionManager::class);
        $this->app->bind(MigrateCommand::class, function() {
            echo '<pre>';
            print_r(321);
            echo '</pre>';
            exit;
        });
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                MigrateSchemaCommand::class,
                MigrateCommand::class,
            ]);
        }
    }
}
