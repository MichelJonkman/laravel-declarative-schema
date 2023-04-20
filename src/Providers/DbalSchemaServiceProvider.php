<?php

namespace MichelJonkman\DbalSchema\Providers;

use Illuminate\Support\ServiceProvider;
use MichelJonkman\DbalSchema\Console\MigrateSchemaCommand;
use MichelJonkman\DbalSchema\Database\ConnectionManager;

class DbalSchemaServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->scoped(ConnectionManager::class);
    }

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                MigrateSchemaCommand::class,
            ]);
        }
    }
}
