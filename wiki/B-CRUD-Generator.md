When you create a new Model you might want to have a full working API CRUD out of the box, well, you in the right place, this is what this package does.

> If you are not using Lumen, this package requires you to implement the responses, replace LumentJsonResponse, with your own to be able to respond something different than Jsons responses, open an [issue](https://github.com/kikoseijo/kLaravel/issues), ill be able to help.

### Index of content

- [Controller and Interactions](#controller-and-interactions)
- [Routes](#routes)
- [Swagger](#swagger)
- [Advanced example](#advanced-example)
- [Batch creation](#batch-creation)

## Your 1st CRUD

Start by running this following command the console, (always at the root of your project, of course):

```
php artisan ksoft:krud --help
```

Will output all possible options you can use when creating the CRUD, will look similar to this:

```bash
Usage:
  ksoft:krud [options] [--] <model>

Arguments:
  model                  table name from where you want krud generated

Options:
  -R, --no-routes        In enabled will not write route to api.php (will print on screen)
  -F, --folder[=FOLDER]  Optional, recommended Subfolder to save files to
  -P, --prefix[=PREFIX]  Route prefix
```

The only required argument its the table name, now we are going to generate a CRUD, for example:

```
php artisan ksoft:krud users
```

Will give you an output similar to this:

```
-------- [CONTRACT] => [INTERACTION] AppServiceProvider.php ----------
// user
'Contracts\Repositories\UserRepository' => 'Repositories\UserRepository',
'Contracts\Interactions\UserUpdate' => 'Interactions\UserUpdate',
'Contracts\Interactions\UserCreate' => 'Interactions\UserCreate',
-------- [Resource Route] => routes/api.php ----------
lumen_resource($router, '/user', 'user', 'UserController');

Route for model user created in /routes/api.php
```


This command generates several files, a ***Controller*** for your model that extends from `App\Http\Controllers\BaseKrudController` (you might need to publish this file also with `ksoft:publish`),
a ***Repository*** that extends EloquentRepo `Ksoft\Klaravel\Repositories\EloquentRepo` and implements its own Contract, ***2 interactions*** the Create Interaction and the Update Interaction, will also generate the Contracts.

## Controller and Interactions

If you go ahead and start using Contracts (they really help maintainability) then register the contracts in your App service provider, otherwise change references and delete the files.

```
$services = [
    'Contracts\Repositories\UserRepository' => 'Repositories\UserRepository',
    'Contracts\Interactions\UserUpdate' => 'Interactions\UserUpdate',
    'Contracts\Interactions\UserCreate' => 'Interactions\UserCreate',
];

foreach ($services as $key => $value) {
    $this->app->singleton('App\\'.$key, 'App\\'.$value);
}
```

if you dont register the services contracts, you will find an excepcion like this:

```
[Illuminate\Contracts\Container\BindingResolutionException]                                                                   
Target [App\Contracts\Repositories\userRepository] is not instantiable while building [App\Http\Controllers\UserController].
```

## Routes

You will also find a function able to generate your routes at runtime, this functionality comes from a dependancy from another package [kevupton/ethereal](https://github.com/kevupton/ethereal), you will find this in  `routes/api.php` with the API routes to start building your recently created model CRUD.

```
lumen_resource($router, '/user', 'user', 'UserController');
```

This provides you with the following:

+--------+----------+--------------------+--------------+---------------------------------------------+------------+
| Domain | Method   | URI                | Name         | Action                                      | Middleware |
+--------+----------+--------------------+--------------+---------------------------------------------+------------+
|        | GET|HEAD | api/user           | user.index   | App\Http\Controllers\UserController@index   | api        |
|        | POST     | api/user           | user.store   | App\Http\Controllers\UserController@store   | api        |
|        | GET|HEAD | api/user/create    | user.create  | App\Http\Controllers\UserController@create  | api        |
|        | GET|HEAD | api/user/{id}      | user.show    | App\Http\Controllers\UserController@show    | api        |
|        | PUT      | api/user/{id}      | user.update  | App\Http\Controllers\UserController@update  | api        |
|        | DELETE   | api/user/{id}      | user.destroy | App\Http\Controllers\UserController@destroy | api        |
|        | GET|HEAD | api/user/{id}/edit | user.edit    | App\Http\Controllers\UserController@edit    | api        |
+--------+----------+--------------------+--------------+---------------------------------------------+------------+

## Swagger

This package also provides all Swagger annotations of your CRUD, you can simple run swagger over the files and will be able to collect he specs of the full CRUD out of the Controller.

Only requirement its that you move model specs from controller file to the model, complete the model with your other properties and you are done.

For more info about this functionality move to [Swagger Generator](https://github.com/kikoseijo/kLaravel/wiki/C-Swagger-generator) section in this Wiki, or run your favorite generator, this package uses [Swagger-php](https://github.com/zircote/swagger-php) package from [http://zircote.com/swagger-php/](http://zircote.com/swagger-php/)

> this package does not provide views or endpoints to view swagger, you can try [kevupton/auto-swagger-ui](https://github.com/kevupton/auto-swagger-ui)

## Advanced example:

Lets create a full CRUD for a model named *Role* inside a Subfolder
called *Admin*, we want our routes to have a prefix of *v1*, we doing this using our crud command from the console in the project directory.

```bash
$ php artisan make:krud roles --folder=Admin --prefix=v1
```

> ***Pay attention we using table name, will serve to generate the models files in a future release.***

## Batch creation

We could make this even more cool, imagin you allready migrations and so, lets generate all CRUD for given models,add this to your route file and visiting `/krud`, configure to your needs.

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
  // We dont get the prints of the contracts,
  // you can work this out easy with a couple of `echo´s` I bet you a beer you can!
  echo 'All jobs done done.';

});
```

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


Isn´t this Cool?


Checkout [swagger section|#swagger] for next steps.
