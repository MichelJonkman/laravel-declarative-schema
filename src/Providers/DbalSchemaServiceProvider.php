<?php

namespace MichelJonkman\DbalSchema\Providers;

use Illuminate\Support\ServiceProvider;
use MichelJonkman\DbalSchema\Console\MigrateSchemaCommand;

class DbalSchemaServiceProvider extends ServiceProvider
{
    public function register()
    {
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
