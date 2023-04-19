<?php

namespace MichelJonkman\DirectorExample\Providers;

use Illuminate\Support\AggregateServiceProvider;

class DirectorServiceProvider extends AggregateServiceProvider
{
    protected $providers = [
        FrontendServiceProvider::class,
    ];
}
