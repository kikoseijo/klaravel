<?php

namespace Ksoft\Klaravel\Console\Commands;

use Illuminate\Console\Command;
use Ksoft\Klaravel\Console\Helpers\LaravelSwagger;
use Illuminate\Database\Eloquent\Model;
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

        $models_path = config('ksoft.swagger.models_path');
        $excluded_models = config('ksoft.swagger.excluded_models', []);

        $model_files = app('files')->files(app_path($models_path));

        foreach ($model_files as $model_file) {
          $model_name = pathinfo($model_file)['filename'];
          $model = '\\App\\'.str_replace('/', '\\', $models_path).$model_name;
          if (!in_array($model_name, $excluded_models)) { //  && (new $model()) instanceof Model
              $models[] = $model; // \App\Models\ChatMessage::class;
          }
        }
        $models = [
            \App\Models\ChatMessage::class
        ];
        $this->line(json_encode($models));
        // return;
        // logi(json_encode($models));
        // $models[] = \App\Models\ChatMessage::class;
        // $models[] = \App\Models\ChatUser::class;
        // $models[] = \App\Models\Chat::class;
        // $models[] = \App\Models\Friend::class;
        // $models[] = \App\Models\Genre::class;
        // $models[] = \App\Models\Hub::class;
        // $models[] = \App\Models\HubMember::class;
        // $models[] = \App\Models\Playlist::class;
        // $models[] = \App\Models\PlaylistTrack::class;
        // $models[] = \App\Models\Post::class;
        // $models[] = \App\Models\PrivateMessage::class;
        // $models[] = \App\Models\Role::class;
        // $models[] = \App\Models\Setting::class;
        // $models[] = \App\Models\User::class;

        //logi(json_encode($models));
        // $options['processors'] = array_merge([new LaravelSwagger($models)], Analysis::processors());
        // $swagger = \Swagger\scan($directory, $options);
        //
        /** @var Swagger\Annotations\Swagger $swagger */
        $swagger = \Kevupton\LaravelSwagger\scan($directory, compact('models'));

        $docDir = config('ksoft.swagger.json_path');
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
