<?php

namespace MichelJonkman\LaravelDeclarativeSchema\Providers;

use DB;
use Illuminate\Database\Migrations\Migrator;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use MichelJonkman\DeclarativeSchema\Database\ConnectionManager;
use MichelJonkman\DeclarativeSchema\Database\SchemaCreator;
use MichelJonkman\DeclarativeSchema\Database\SchemaMigrator;
use MichelJonkman\DeclarativeSchema\Exceptions\Exception;
use MichelJonkman\DeclarativeSchema\Schema;

class SchemaServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->scoped(ConnectionManager::class);
        $this->app->scoped(SchemaCreator::class);
        $this->app->scoped(Schema::class);
        $this->app->scoped(SchemaMigrator::class);

        $this->app->scoped(Migrator::class, function (Application $app) {
            return $app->make('migrator');
        });
    }

    /**
     * @throws Exception
     */
    public function boot(Schema $schema, SchemaMigrator $schemaMigrator, Application $app): void
    {
        $config = DB::connection()->getConfig();

        $schema->setConfig([
            'production' => $app->isProduction(),

            'base_path' => base_path(),

            'load_from' => [
                'database/schema'
            ],

            'connection' => [
                'dbname' => $config['database'],
                'user' => $config['username'],
                'password' => $config['password'],
                'host' => $config['host'],
                'driver' => 'pdo_' . $config['driver'],
            ]
        ]);

        $schema->loadSchemaFrom($schemaMigrator->getSchemaPath());
    }
}
