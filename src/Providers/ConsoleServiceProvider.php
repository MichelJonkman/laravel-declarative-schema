<?php

namespace MichelJonkman\LaravelDeclarativeSchema\Providers;

use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;
use MichelJonkman\LaravelDeclarativeSchema\Console\MigrateCommand;
use MichelJonkman\DeclarativeSchema\Console\MakeSchemaCommand;
use MichelJonkman\DeclarativeSchema\Console\MigrateSchemaCommand;

class ConsoleServiceProvider extends ServiceProvider implements DeferrableProvider
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
