<?php

namespace Ksoft\Klaravel\Console\Commands;

use Illuminate\Console\Command;
use Ksoft\Klaravel\Console\Helpers\TableFieldsGenerator;

class MakeKrud extends Command
{
    // for development...
    /**
     * @var mixed
     */
    protected $force = false;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ksoft:krud
                            {model : table name from where you want CRUD generated}
                            {--R|no-routes : if this flag is enabled, routes will not be writen to api.php (Only on screen)}
                            {--F|folder= : Optional, recommended Subfolder to save files to}
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
        'controller'         => '/controllers/ExampleController.php',
        'contract'           => '/Contracts/ExampleRepository.php',
        'repo'               => '/Repositories/ExampleRepository.php',
        'update_contract'    => '/Contracts/ExampleUpdate.php',
        'create_contract'    => '/Contracts/ExampleCreate.php',
        'update_interaction' => '/Interactions/ExampleUpdate.php',
        'create_interaction' => '/Interactions/ExampleCreate.php',
    ];

    /**
     * This valiable defines where to save each model/class...
     *
     * @var array
     */
    protected $write_paths;

    /**
     * @var mixed
     */
    protected $model;
    /**
     * @var mixed
     */
    protected $model_name;
    /**
     * @var mixed
     */
    protected $fileManager;
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
        // Setup vars. $this-> etc..
        $this->prepareThings();

        // Disabled- Generate model file from DB table.
        $this->generateModelFromDb();

        // For each available template, add to Model.
        foreach ($this->stubs as $key => $stub) {
            $this->makeKrudItem($key, $stub);
        }

        // Print Contract lines in console.
        $this->error('-------- [CONTRACT] => [INTERACTION] AppServiceProvider.php ----------');
        $this->info("// $this->model_name");
        foreach ($this->printableContracts as $line) {
            $this->info($line);
        }

        // Print + Write? Routes.
        $this->writeRoutes();

    }

    /**
     * Create a new item for model.
     */
    protected function makeKrudItem($key, $stub)
    {
        // If its disabled from config
        if (!is_array($this->write_paths) || !array_key_exists($key, $this->write_paths)) {
            return;
        }
        $content  = $this->fileManager->get(KLARAVEL_PATH.'/stubs'.$stub);
        $fileName = $this->getFileName($stub);

        $modelSingularName = str_singular($this->model_name);
        $subfolderName     = $this->option('folder') ? '\\'.$this->option('folder') : '';

        $replacements = [
            '%folder%'         => $this->option('folder'),
            '%subfolder%'      => $subfolderName,
            '%model%'          => $this->model_name,
            '%modelSingular%'  => $modelSingularName,
            '%model_path%'     => $this->namespace_model,
            '%table_name%'     => snake_case($this->model_name),
            '%model_name_url%' => kebab_case($this->model_name),
        ];

        $content = str_replace(array_keys($replacements), array_values($replacements), $content);

        $subFolder = $this->option('folder') ? $this->option('folder').'/' : '';

        $fileDirectory = app()->basePath().'/app/'.$this->write_paths[$key].$subFolder;
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
        } elseif (!$this->force && !$this->laravel->runningInConsole() && $this->fileManager->exists($filePath)) {
            // Overwrite its not enabled, we runing in console, file exists.
            // we do nothing here....
        } elseif (!$this->fileManager->exists($filePath) || ($this->fileManager->exists($filePath) && $this->force)) {
            $this->fileManager->put($filePath, $content);
        }

        if (0 === strpos($this->write_paths[$key], 'Contracts/')) {
            $shortName                  = str_replace('.php', '', $fileName);
            $contract                   = str_replace('/', '\\', $this->write_paths[$key].$subFolder.$shortName);
            $repo                       = str_replace('Contracts\\', '', $contract);
            $this->printableContracts[] = "'$contract' => '$repo',";
        }
        //$this->line("The [{$fileName}] has been created.");
    }

    protected function prepareThings()
    {
        $name       = studly_case(str_singular($this->argument('model')));
        $path       = config('ksoft.models_path');
        $full_model = app()->getNamespace().$path.$name;

        $this->fileManager     = app('files');
        $this->write_paths     = config('ksoft.krud.paths');
        $this->force           = config('ksoft.krud.force_rewrite');
        $this->namespace_model = str_replace('/', '\\', $full_model);
        $modelParts            = explode('\\', $this->namespace_model);
        $this->model_name      = array_pop($modelParts);
    }

    protected function generateModelFromDb()
    {

        // Disabled for now, uncomment and require libraries if yo uwnat to use it....
        if ($this->force && !class_exists($this->namespace_model)) {
            $tableFieldsGenerator = new TableFieldsGenerator(snake_case($this->argument('model')));
            $tableFieldsGenerator->prepareFieldsFromTable();
            $tableFieldsGenerator->prepareRelations();
            $this->fields = $tableFieldsGenerator->fields;
            //$this->relations = $tableFieldsGenerator->relations;
            // $this->call('code:models', ['--table' => snake_case($this->model_name)]);
            // $this->call('infyom:model', ['model' => str_singular($this->model_name), '--fromTable' => 'yes']);
        }

    }

    /**
     * @return null
     */
    protected function writeRoutes()
    {
        $prefix = $this->option('prefix') ? $this->option('prefix') : '';
        $folder = $this->option('folder') ? $this->option('folder').'\\' : '';

        $newRoutes = $this->fileManager->get(KLARAVEL_PATH.'/stubs/routes/resource.stub');

        $replacements = [
            '%modelo%'   => $this->model_name,
            '%keyname%'  => kebab_case($this->model_name),
            '%prefix%'   => ($prefix ? $prefix.'.' : ''),
            '%prefixed%' => '/'.($prefix ? $prefix.'/' : ''),
            '%folder%'   => $folder,
        ];
        $parsedRoutes = str_replace(array_keys($replacements), array_values($replacements), $newRoutes);
        $this->error('-------- [Resource Route] => routes/api.php ----------');
        $this->info($parsedRoutes);

        if ($this->option('no-routes')) {
            return;
        }

        if (config('ksoft.krud.write_routes')) {
            $routes_path   = app()->basePath().'/routes/api.php';
            $routeContents = file_get_contents($routes_path);
            $routeContents .= "\n\n".$parsedRoutes;
            file_put_contents($routes_path, $routeContents);
            $this->info('Route for model '.$this->model_name.' created in /routes/api.php');
        }

    }

    /**
     * @param $filePath
     */
    protected function getFileName($filePath)
    {
        $arr  = explode('/', $filePath);
        $name = end($arr);
        return str_replace('Example', $this->model_name, $name);
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
