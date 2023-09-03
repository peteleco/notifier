<?php

namespace Peteleco\Notifier\Commands;

use Illuminate\Console\Command;

class NotifierCommand extends Command
{
    public $signature = 'notifier';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
