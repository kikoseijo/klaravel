
- [Command example](#command-example)
- [Batch creation](#batch-creation)
- [What this crud does?](#what-this-krud-does)

## Description

The purpose of this functionality its to generate for you classes for your Model with extra functionality.  
It produces a clean way to work with large projects, on an easy to maintaining project structure.  
In conjunction with the Swagger generator turns your development environment with extra productivity by focusing effort in what matters, the *project logic*. 

### Command example:

Lets create a full CRUD for a model named *Role* inside a Subfolder
called *Admin*, we want our routes to have a prefix of *v1*, we doing this using our crud command from the console in the project directory.

```bash
$ php artisan make:krud Roles --folder=Admin --prefix=v1
```

> ***Pay attention we using plural in the line below to match the table name, doing the opposite will not guarantee me match the table name on some languages limitations.***

### Batch creation

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

### What this KRUD does?

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


Checkout [swagger section|#swagger] for next steps.