<?php

namespace MichelJonkman\DbalSchema\Database;

use Doctrine\DBAL\Schema\Column;
use Doctrine\DBAL\Schema\SchemaException;

class Table extends \Doctrine\DBAL\Schema\Table
{
    /**
     * @throws SchemaException
     */
    public function addId(string $name = null): Column
    {
        $name = $name ?: 'id';

        $column = $this->addColumn($name, 'integer', ['unsigned' => true])->setAutoincrement(true);
        $this->setPrimaryKey([$name]);

        return $column;
    }

    /**
     * @throws SchemaException
     */
    public function addTimestamps(): void
    {
        $this->addColumn('created_at', 'datetime')->setNotnull(false);
        $this->addColumn('updated_at', 'datetime')->setNotnull(false);
    }
}
