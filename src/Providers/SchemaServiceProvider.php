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
use MichelJonkman\DbalSchema\Database\SchemaMigrator;
use MichelJonkman\DbalSchema\Schema;

class SchemaServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->scoped(Migrator::class, function (Application $app) {
            return $app->make('migrator');
        });

        $this->app->singleton(SchemaCreator::class, function ($app) {
            return new SchemaCreator($app['files'], $app->basePath('stubs'));
        });

        $this->app->scoped(Schema::class);
    }

    public function boot(): void
    {
        app(Schema::class)->loadSchemaFrom(app(SchemaMigrator::class)->getSchemaPath());
    }
}
