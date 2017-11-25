<?php

namespace Ksoft\Klaravel\Console\Commands;

use Illuminate\Console\Command;

class MakeKrud extends Command
{

    protected $force = false;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ksoft:krud
                            {model : Model name}
                            {--R|no-routes : Dont add dynamic rotues to api.php}
                            {--F|folder= : Optional Subfolder}
                            {--P|prefix= : Route prefix}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command will create C+U Interaction with Contracts, Controller and Respository';

    /**
     * Stub paths.
     *
     * @var array
     */
    protected $stubs = [
        // 'controller'         => '/controllers/ExampleController.php',
        // 'contract'           => '/Contracts/ExampleRepository.php',
        'repo'               => '/Repositories/ExampleRepository.php',
        // 'update_contract'    => '/Contracts/ExampleUpdate.php',
        // 'create_contract'    => '/Contracts/ExampleCreate.php',
        // 'update_interaction' => '/Interactions/ExampleUpdate.php',
        // 'create_interaction' => '/Interactions/ExampleCreate.php',
    ];

    /**
     * This valiable defines where to save each model/class...
     *
     * @var array
     */
    protected $paths;

    /**
     * @var mixed
     */
    protected $model;
    /**
     * @var mixed
     */
    protected $modelName;
    /**
     * @var mixed
     */
    protected $fileManager;
    /**
     * @var mixed
     */
    protected $appNamespace;
    /**
     * @var array
     */
    protected $printableContracts = [];

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $this->fileManager  = app('files');
        $this->paths = config('ksoft.krud.paths');
        $this->appNamespace = app()->getNamespace();
        $this->setupModelName();

        foreach ($this->stubs as $key => $stub) {
            $this->makeKrudItem($key, $stub);
        }

        $this->error('-------- CONTRACTS ----------');
        $this->info("// $this->modelName");
        foreach ($this->printableContracts as $line) {
            $this->info($line);
        }

        $this->writeRoutes();

    }

    /**
     * Create a new item for model.
     */
    protected function makeKrudItem($key, $stub)
    {
        // If its disabled from config
        if (!is_array($this->paths) || !array_key_exists($key, $this->paths)) {
            return;
        }

        $content  = $this->fileManager->get(KLARAVEL_PATH.'/stubs' . $stub);
        $fileName = $this->getFileName($stub);

        $subfolderName = $this->option('folder') ? '\\'.$this->option('folder') : '';

        $replacements = [
            '%subfolder%'     => $subfolderName,
            '%model%'         => $this->modelName,
            '%modelSingular%' => str_singular($this->modelName),
            '%table_name%'    => snake_case($this->modelName),
            '%model_name_url%'    => kebab_case($this->modelName),
        ];

        $content = str_replace(array_keys($replacements), array_values($replacements), $content);

        $subFolder = $this->option('folder') ? $this->option('folder').'/' : '';

        $fileDirectory = app()->basePath().'/app/'.$this->paths[$key].$subFolder;
        $filePath      = $fileDirectory.$fileName;

        // $this->line("Will create $filePath.");

        // Create folder if does not exists.
        if (!$this->fileManager->exists($fileDirectory)) {
            $this->fileManager->makeDirectory($fileDirectory, 0755, true);
        }

        if (!$this->force && $this->laravel->runningInConsole() && $this->fileManager->exists($filePath)) {
            $response = $this->ask("The [{$fileName}] already exists. Do you want to overwrite it?", 'Yes');

            if (!$this->isResponsePositive($response)) {
                $this->line("The contract [{$fileName}] will not be overwritten.");
                return;
            }
            $this->fileManager->put($filePath, $content);
        } else {
            $this->fileManager->put($filePath, $content);
        }

        if (0 === strpos($this->paths[$key], 'Contracts/')) {
            $shortName                  = str_replace('.php', '', $fileName);
            $contract                   = str_replace('/', '\\', $this->paths[$key].$subFolder.$shortName);
            $repo                       = str_replace('Contracts\\', '', $contract);
            $this->printableContracts[] = "'$contract' => '$repo',";
        }
        //$this->line("The [{$fileName}] has been created.");
    }

    protected function setupModelName()
    {
        $model           = $this->appNamespace.$this->argument('model');
        $this->model     = str_replace('/', '\\', $model);
        $modelParts      = explode('\\', $this->model);
        $this->modelName = array_pop($modelParts);
        if ($this->force || !class_exists($this->model)) {
            // $this->call('code:models', ['--table' => snake_case($this->modelName)]);
            // $this->call('infyom:model', ['model' => str_singular($this->modelName), '--fromTable' => 'yes']);
        }
    }

    protected function writeRoutes()
    {
      $prefix = $this->option('prefix') ? $this->option('prefix') : '';
      $folder = $this->option('folder') ? $this->option('folder') . '\\' : '';

      $newRoutes  = $this->fileManager->get(KLARAVEL_PATH.'/stubs/routes/resource.stub');

      $replacements = [
          '%modelo%'     => $this->modelName,
          '%keyname%'    => kebab_case($this->modelName),
          '%prefix%' => ($prefix?$prefix.'.':''),
          '%prefixed%' => '/' . ($prefix? $prefix.'/' : ''),
          '%folder%'    => $folder,
      ];
      $parsedRoutes = str_replace(array_keys($replacements), array_values($replacements), $newRoutes);

      $this->info($parsedRoutes);

      if ($this->option('no-routes')){
          return;
      }

      if (config('ksoft.krud.write_routes')) {
          $routes_path = app()->basePath().'/routes/api.php';
          $routeContents = file_get_contents($routes_path);
          $routeContents .= "\n\n".$parsedRoutes;
          file_put_contents($routes_path, $routeContents);
          $this->info('Route for model ' . $this->modelName . ' created in /routes/api.php');
      }

    }

    /**
     * @param $filePath
     */
    protected function getFileName($filePath)
    {
        $arr  = explode('/', $filePath);
        $name = end($arr);
        return str_replace('Example', $this->modelName, $name);
    }

    protected function isLumen()
    {
        return str_contains(app()->version(), 'Lumen');
    }

    /**
     * @param $response
     */
    public function isResponsePositive($response)
    {
        return in_array(strtolower($response), ['y', 'yes']);
    }
}
