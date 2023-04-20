<?php

namespace MichelJonkman\DbalSchema\Console;

use Illuminate\Console\Command;
use MichelJonkman\DbalSchema\Database\SchemaCreator;

class MigrateSchemaCommand extends Command
{
    protected $signature = 'migrate:schema';

    protected $description = 'Migrate the declarative schema\'s';

    public function handle()
    {
        $this->info('Migrating declarative schema...');

        $creator = app(SchemaCreator::class);

        $creator->migrateSchema($this->getSchemaPath());

        echo '<pre>';
        print_r($this->getSchemaPath());
        echo '</pre>';
        exit;
    }

    public function getSchemaPath() {
        return $this->laravel->databasePath().DIRECTORY_SEPARATOR.'schema';
    }
}
