<?php

namespace MichelJonkman\DbalSchema\Console;

use Exception;
use Illuminate\Console\Command;
use Illuminate\Contracts\Console\PromptsForMissingInput;
use Illuminate\Database\Console\Migrations\TableGuesser;
use Illuminate\Support\Str;
use MichelJonkman\DbalSchema\Database\SchemaCreator;
use MichelJonkman\DbalSchema\Database\SchemaMigrator;

class MakeSchemaCommand extends Command implements PromptsForMissingInput
{
    protected $signature = 'make:schema {table : The table name}
        {--create= : The table to be created}
        {--path= : The location where the migration file should be created}
        {--realpath : Indicate any provided migration file paths are pre-resolved absolute paths}
        {--fullpath : Output the full path of the migration (Deprecated)}';


    protected $description = 'Create a new migration file';

    public function __construct(protected SchemaCreator $creator, protected SchemaMigrator $migrator)
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     * @throws Exception
     */
    public function handle(): void
    {
        $table = $this->input->getArgument('table');
        $name = Str::snake(trim($table));

        $this->writeSchema($name, $table);
    }

    /**
     * @throws Exception
     */
    protected function writeSchema(string $name, string $table): void
    {
        $file = $this->creator->create(
            $name, $this->getSchemaPath(), $table
        );

        $this->components->info(sprintf('Schema file [%s] created successfully.', $file));
    }

    /**
     * Get migration path (either specified by '--path' option or default location).
     *
     * @return string
     */
    protected function getSchemaPath(): string
    {
        if (!is_null($targetPath = $this->input->getOption('path'))) {
            return !$this->usingRealPath()
                ? $this->laravel->basePath().'/'.$targetPath
                : $targetPath;
        }

        return $this->migrator->getSchemaPath();
    }

    /**
     * Prompt for missing input arguments using the returned questions.
     *
     * @return array
     */
    protected function promptForMissingArgumentsUsing(): array
    {
        return [
            'name' => 'What should the schema file be named?',
        ];
    }

    protected function usingRealPath(): bool
    {
        return $this->input->hasOption('realpath') && $this->option('realpath');
    }
}
