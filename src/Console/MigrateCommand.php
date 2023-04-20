<?php

namespace MichelJonkman\DbalSchema\Console;


class MigrateCommand extends \Illuminate\Database\Console\Migrations\MigrateCommand
{
    public function handle(): int
    {
        echo '<pre>';
        print_r(123);
        echo '</pre>';
        exit;

        if (!$this->confirmToProceed()) {
            return 1;
        }

        $this->addOption('force');

        return parent::handle();
    }
}
