<?php

namespace MichelJonkman\DbalSchema\Console;

use Illuminate\Console\Command;

class MigrateSchemaCommand extends Command
{
    protected $signature = 'migrate:schema';

    protected $description = 'Migrate the declarative schema\'s';

    public function handle()
    {
        $this->info('Migrating declarative schema...');

        echo '<pre>';
        print_r($this->getSchemaPath());
        echo '</pre>';
        exit;
    }

    public function getSchemaPath() {
        return $this->laravel->databasePath().DIRECTORY_SEPARATOR.'schema';
    }
}
