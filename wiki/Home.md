
The main purpose of this package its to generate on the fly several classes inside your projects,
on a clean an easy way will provide by default with full CRUD with Swagger generation on a clever and simple
way.

This are the main functionalities you can find on this package-library.

- [Wiki Index](https://github.com/kikoseijo/kLaravel/wiki/Wiki-Credits-&-thanks)

### Example:

We are going to create a full CRUD for the models *Role* inside a Subfolder
called *Admin* and route prefix *v1* crud using the console

```bash
$ php artisan make:krud Roles --folder=Admin --prefix=v1
```

We could do it even more dynamic adding this to your route file and visiting `/krud`, because will generate it from an array at once.

```php
// routes/web.php
use Illuminate\Support\Facades\Artisan;

$prefix = 'v1';
$theKruds = [
  'ChatMessages' => 'User',
  'ChatUsers' => 'User',
  'Chats' => 'User',
  'Settings' => 'User',
  'Users' => 'User',
  'PrivateMessages' => 'User',
  'Roles' => 'Admin',
];

Route::get('krud', function () use ($theKruds){
  foreach ($theKruds as $kKey => $kVal){
    echo "doing KRUD for $kKey<br>\n";
    Artisan::call('ksoft:krud', [
      'model' => $kKey, '--folder' => $kVal, '--prefix' => $prefix
    ]);
  }
  echo 'All jobs done done.';
});
```

### What will KRUD produce

Will give you following structure from each given model: replacing 'Example' with your model name.

| Functionality | FilePath
| --- | ---
| Model Controller | /Controllers/Subfolder/ExampleController.php
| Controller Contract | /Contracts/Subfolder/ExampleRepository.php
| Model repository | /Repositories/Subfolder/ExampleRepository.php
| Update Interaction Contract | /Contracts/Subfolder/ExampleUpdate.php
| Create Interaction Contract | /Contracts/Subfolder/ExampleCreate.php
| Update Interaction | /Interactions/Subfolder/ExampleUpdate.php
| Create Interaction | /Interactions/Subfolder/ExampleCreate.php

This package will add a single line for building a full crud api route, and will save it to `routes\api.php` with the following:

```php
/**
 * Chats Krud Resource Route
 */
lumen_resource($router, '/v1/chats', 'v1.chats', 'User\ChatsController');

```

# Full procedure


The full scope of this start making the models by generating the migrations, spend time on this, so, start by:

- Creating your Migrations.
- Make Seeders, its not strictly necesary, but you should...
- Make your model (*Working* on automate this, follow this guide: [Ethereal](https://github.com/kevupton/ethereal/wiki/ethereal))
- Generate CRUD: `php artisan ksoft:krud Model`
- Generate Swagger: `php artisan ksoft:swagger`

Thats all, you got full working API, with its Swagger v2 Specks,

So, basicaly, instead of creating each of this configuration, this package does it for you, isnt it handy? will create the files for each model, this command will produce this files, extending all its base functionality from other packages thats provides an extra layer of functionality.

### and now What?

Well, if yo got reading this far all this above might make sense to you, am i right?  

You should concentrate in validation, make custom validations if you need them, if you havent done so when creating the models, othewise just concentrate on giving your app the customized functionality, you can overwrite all functionality thanks to the class this files extends from. Just follow the [thanks section](#thanks) to have a deeper understanting of what all this is about, or checkout dependancies on composer.json-


### Notes

Generating model directly from the table database its one of the next features, right now you could have it done with couple packages, them both not enabled right now.

```php
\\ Ksoft\Klaravel\Console\Commands\MakeKrud
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
```