<?php

namespace Ksoft\Klaravel\Console\Commands;

use Illuminate\Console\Command;
use Ksoft\Klaravel\Console\Helpers\Publisher;

class PublishConfig extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'ksoft:publish-config';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish config';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->info('Publish config files');

        $configDir = base_path('config');

        (new Publisher($this))->publishFile(
            KLARAVEL_PATH.'/stubs/config/ksoft.php',
            $configDir,
            'ksoft.php'
        );
    }
}
