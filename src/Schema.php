<?php

namespace MichelJonkman\DbalSchema;

class Schema
{
    protected array $schemaPaths = [];

    public function loadSchemaFrom(string|array $paths): void
    {
        if (is_string($paths)) {
            $paths = [$paths];
        }

        $this->schemaPaths = array_merge($this->schemaPaths, $paths);
    }

    public function getSchemaPaths(): array
    {
        echo '<pre>';
        print_r($this->schemaPaths);
        echo '</pre>';
        exit;

        return $this->schemaPaths;
    }

}
