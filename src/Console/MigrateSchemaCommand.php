<?php

namespace MichelJonkman\DbalSchema\Console;

use Doctrine\DBAL\Exception;
use Doctrine\DBAL\Schema\SchemaException;
use Illuminate\Console\Command;
use MichelJonkman\DbalSchema\Database\SchemaMigrator;
use MichelJonkman\DbalSchema\Exceptions\DeclarativeSchemaException;

class MigrateSchemaCommand extends Command
{
    protected $signature = 'migrate:schema';

    protected $description = 'Migrate the declarative schema\'s';

    /**
     * @throws SchemaException
     * @throws Exception
     * @throws DeclarativeSchemaException
     */
    public function handle(): void
    {
        $this->info('Migrating declarative schema...');

        $migrator = app(SchemaMigrator::class);
        $migrator->setOutput($this->getOutput());

        $migrator->migrateSchema($migrator->getDeclarations($this->getSchemaPath()));

        $this->info('Done');
    }

    public function getSchemaPath(): string
    {
        return $this->laravel->databasePath().DIRECTORY_SEPARATOR.'schema';
    }
}
