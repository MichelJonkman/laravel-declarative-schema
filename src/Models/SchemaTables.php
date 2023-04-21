<?php

namespace MichelJonkman\DbalSchema\Models;

use Illuminate\Database\Eloquent\Model;
use MichelJonkman\DbalSchema\Database\SchemaMigrator;

class SchemaTables extends Model
{

    protected $fillable = [
        'table'
    ];

    public function __construct(array $attributes = [])
    {
        $this->table = app(SchemaMigrator::class)->getSchemaTableName();

        parent::__construct($attributes);
    }
}
