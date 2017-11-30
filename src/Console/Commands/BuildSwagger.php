<?php

namespace Ksoft\Klaravel\Console\Commands;

use Illuminate\Console\Command;
use Ksoft\Klaravel\Console\Helpers\LaravelSwagger;
use Illuminate\Database\Eloquent\Model as Eloquent;
use Swagger\Analysis;
use Swagger\Annotations\Swagger;
use Symfony\Component\Finder\Finder;

class BuildSwagger extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ksoft:swagger';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate swagger definition with models.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $directory = app_path();
        // logi($directory);
        $this->defineConstants(config('ksoft.swagger.constants') ?: []);

        $models_path = config('ksoft.models_path');
        $excluded_models = config('ksoft.swagger.excluded_models', []);

        $model_files = app('files')->files(app_path($models_path));

        foreach ($model_files as $model_file) {
          $model_name = pathinfo($model_file)['filename'];
          $model = 'App\\'.str_replace('/', '\\', $models_path).$model_name;
          if (!in_array($model_name, $excluded_models) && (new $model()) instanceof Eloquent) { //
              $models[] = $model; // \App\Models\ChatMessage::class;
          }
        }

        $this->line('Valid models found in path: '. app_path($models_path));
        $this->line(json_encode($models));

        /** @var Swagger\Annotations\Swagger $swagger */
        $swagger = \Swagger\scan($directory, []);

        $docDir = config('ksoft.swagger.json_path');

        if (!app('files')->exists($docDir)) {
            app('files')->makeDirectory($docDir, 0755, true);
        }

        $filename = $docDir.'/'.config('ksoft.swagger.json_name');
        $swagger->saveAs($filename);
        // logi($swagger);
        // logi(json_encode($options));

    }

    protected function defineConstants(array $constants)
    {
        if (! empty($constants)) {
            foreach ($constants as $key => $value) {
              logi("$key => $value");
                defined($key) || define($key, $value);
            }
        }
    }
}
