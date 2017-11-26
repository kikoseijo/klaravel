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
    protected $name = 'ksoft:publish';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Will pubish usefull files, like BaseKrudController and configuration';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->info('Publish config files');

        $optionSelected = $this->choice('What whould you like to publish?', ['all', 'Configuration', 'BaseKrudController'], 0);

        if ($optionSelected == 'all' || $optionSelected == 'Configuration') {
            $this->publishConfig();
            $this->info('Publish configuration file: <info>✔</info>');
        }

        if ($optionSelected == 'all' || $optionSelected == 'BaseKrudController') {
            $this->publishBaseKrud();
            $this->info('Publish BaseKrudController file: <info>✔</info>');

        }
    }

    protected function publishConfig(){
      (new Publisher($this))->publishFile(
          KLARAVEL_PATH.'/stubs/config/ksoft.php',
          base_path('config'),
          'ksoft.php'
      );
    }

    protected function publishBaseKrud(){
      (new Publisher($this))->publishFile(
          KLARAVEL_PATH.'/stubs/controllers/BaseKrudController.php',
          base_path('app/Http/Controllers'),
          'BaseKrudController.php'
      );
    }
}
