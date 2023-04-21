<?php

namespace MichelJonkman\DbalSchema\Console;

class MigrateCommand extends \Illuminate\Database\Console\Migrations\MigrateCommand
{
    public function handle()
    {
        if (!$this->confirmToProceed()) {
            return 1;
        }

        $this->call('migrate:schema', array_filter([
            '--force' => true,
        ]));

        $this->addOption('force');

        return parent::handle();
    }
}
