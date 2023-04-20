<?php

namespace MichelJonkman\DbalSchema\Database;

use DB;
use Doctrine\DBAL\Schema\Schema;
use MichelJonkman\DbalSchema\Exceptions\DeclarativeSchemaException;

class SchemaCreator
{

    protected ConnectionManager $connectionManager;

    public function __construct(ConnectionManager $connectionManager)
    {
        $this->connectionManager = $connectionManager;
    }

    protected function getSchemaFiles(string $path): array
    {
        return glob("$path/*.php") ?: [];
    }

    /**
     * @return DeclarativeSchema[]
     * @throws DeclarativeSchemaException
     */
    protected function getDeclarations(string $path): array
    {
        $declarations = [];

        foreach ($this->getSchemaFiles($path) as $file) {
            $declaration = include $file;

            if (!$declaration instanceof DeclarativeSchema) {
                throw new DeclarativeSchemaException("Declaration $file does not return a valid DeclarativeSchema class.");
            }

            $declarations[] = $declaration;
        }

        return $declarations;
    }

    /**
     * @throws DeclarativeSchemaException
     */
    public function migrateSchema(string $path): void
    {
        $declarations = $this->getDeclarations($path);
        $connection = $this->connectionManager->getConnection();
        $schemaManager = $connection->createSchemaManager();
        $comparator = $schemaManager->createComparator();

        $oldTables = [];
        $newTables = [];

        foreach ($declarations as $declaration) {
            $newTable = $declaration->declare();
            $tableName = $newTable->getName();

            if ($schemaManager->tablesExist($tableName)) {
                $oldTables[] = $schemaManager->introspectTable($newTable->getName());
            }

            $newTables[] = $newTable;
        }

        $oldSchema = new Schema($oldTables);
        $newSchema = new Schema($newTables);

        $diff = $comparator->compareSchemas($oldSchema, $newSchema);
        $platform = $connection->getDatabasePlatform();

        echo '<pre>';
        print_r($platform->getAlterSchemaSQL($diff));
        echo '</pre>';
        exit;

        DB::transaction(function () {
        });
    }

}
