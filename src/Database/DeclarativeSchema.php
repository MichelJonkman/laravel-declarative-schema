<?php

namespace MichelJonkman\DbalSchema\Database;

use Doctrine\DBAL\Schema\Table;

abstract class DeclarativeSchema
{
    abstract function declare(): Table;
}
