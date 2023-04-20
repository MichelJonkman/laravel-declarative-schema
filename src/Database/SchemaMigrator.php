<?php

namespace MichelJonkman\DbalSchema\Database;

use DB;
use Doctrine\DBAL\Exception;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Schema\SchemaException;
use Doctrine\DBAL\Schema\Table;
use Illuminate\Console\Concerns\InteractsWithIO;
use Illuminate\Console\View\Components\Info;
use Illuminate\Console\View\Components\TwoColumnDetail;
use MichelJonkman\DbalSchema\Exceptions\DeclarativeSchemaException;
use Symfony\Component\Console\Output\OutputInterface;

class SchemaMigrator
{
    protected ConnectionManager    $connectionManager;
    protected OutputInterface|null $output = null;

    public function __construct(ConnectionManager $connectionManager)
    {
        $this->connectionManager = $connectionManager;
    }

    protected function getSchemaFiles(string $path): array
    {
        return glob("$path/*.php") ?: [];
    }

    /**
     * @return Table[]
     * @throws DeclarativeSchemaException
     */
    public function getDeclarations(string $path): array
    {
        $tables = [];

        $this->write(Info::class, 'Gathering declarations.');

        foreach ($this->getSchemaFiles($path) as $file) {
            $declaration = include $file;

            if (!$declaration instanceof DeclarativeSchema) {
                throw new DeclarativeSchemaException("Declaration $file does not return a valid DeclarativeSchema class.");
            }

            $tables[] = $declaration->declare();
        }

        return $tables;
    }


    /**
     * @param  Table[]  $newTables
     *
     * @throws Exception
     * @throws SchemaException
     */
    public function migrateSchema(array $newTables): void
    {
        $this->write(Info::class, 'Calculating schema diff.');

        $connection = $this->connectionManager->getConnection();
        $schemaManager = $connection->createSchemaManager();
        $comparator = $schemaManager->createComparator();

        $oldTables = [];

        foreach ($newTables as $newTable) {
            $tableName = $newTable->getName();

            if ($schemaManager->tablesExist($tableName)) {
                $this->write(TwoColumnDetail::class, $tableName, '<fg=blue;options=bold>EXISTS</>');

                $oldTables[] = $schemaManager->introspectTable($newTable->getName());
            } else {
                $this->write(TwoColumnDetail::class, $tableName, '<fg=green;options=bold>NEW</>');
            }
        }

        $oldSchema = new Schema($oldTables);
        $newSchema = new Schema($newTables);

        $diff = $comparator->compareSchemas($oldSchema, $newSchema);

        if ($diff->isEmpty()) {
            $this->write(Info::class, 'Database already up-to-date.');

            return;
        }

        $platform = $connection->getDatabasePlatform();

        $sqlLines = $platform->getAlterSchemaSQL($diff);

        $this->write(Info::class, 'Running statements.');

        DB::beginTransaction();

        try {
            foreach ($sqlLines as $sql) {
                DB::getPdo()->query($sql);
            }

            DB::commit();
        }
        catch (\Throwable $throwable) {
            DB::rollBack();
            throw $throwable;
        }

        $this->write(Info::class, 'Done');
    }

    protected function hasOuput(): bool
    {
        return $this->output !== null;
    }

    public function setOutput(OutputInterface $output): void
    {
        $this->output = $output;
    }

    protected function write(string $component, ...$arguments): void
    {
        if ($this->output && class_exists($component)) {
            (new $component($this->output))->render(...$arguments);
        }
    }
}
