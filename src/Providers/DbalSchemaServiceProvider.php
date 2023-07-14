<?php

namespace MichelJonkman\DbalSchema\Providers;

use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;
use MichelJonkman\DbalSchema\Console\MakeSchemaCommand;
use MichelJonkman\DbalSchema\Console\MigrateCommand;
use MichelJonkman\DbalSchema\Console\MigrateSchemaCommand;

class DbalSchemaServiceProvider extends ServiceProvider implements DeferrableProvider
{
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
            MakeSchemaCommand::class
        ];
    }
}
