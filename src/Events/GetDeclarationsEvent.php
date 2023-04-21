<?php

namespace MichelJonkman\DbalSchema\Events;

use Doctrine\DBAL\Schema\Table;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Support\Collection;

class GetDeclarationsEvent
{
    use Dispatchable;

    /**
     * @param  Table[]|Collection  $tables
     */
    public function __construct(public array|Collection $tables)
    {
    }
}
