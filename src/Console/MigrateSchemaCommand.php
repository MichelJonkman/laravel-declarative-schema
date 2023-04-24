<?php

namespace MichelJonkman\DbalSchema\Console;

use Doctrine\DBAL\Exception;
use Doctrine\DBAL\Schema\SchemaException;
use Illuminate\Console\Command;
use Illuminate\Console\ConfirmableTrait;
use MichelJonkman\DbalSchema\Database\SchemaMigrator;
use MichelJonkman\DbalSchema\Exceptions\DeclarativeSchemaException;
use Throwable;

class MigrateSchemaCommand extends Command
{
    use ConfirmableTrait;

    protected $signature = 'migrate:schema {--force : Force the operation to run when in production}';

    protected $description = 'Migrate the declarative schema\'s';

    /**
     * @throws SchemaException
     * @throws Exception
     * @throws DeclarativeSchemaException
     * @throws Throwable
     */
    public function handle(): int
    {
        if (! $this->confirmToProceed()) {
            return 1;
        }

        $migrator = app(SchemaMigrator::class);
        $migrator->setOutput($this->getOutput());

        $migrator->migrateSchema($migrator->getDeclarations($migrator->getSchemaPath()));

        return 0;
    }
}
