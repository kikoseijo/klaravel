# Resource policies

`php artisan make:policy RecordsPolicy`

### Base Policy (debug)

```php
namespace App\Policies;

use App\User;
// use App\Policies\Traits\RootPolicyFilter;
use Illuminate\Auth\Access\HandlesAuthorization;

class RecordsPolicy
{
    use HandlesAuthorization;
    // use RootPolicyFilter;

    public function view(User $user, $record)
    {
        // logi('RecordsPolicy: view + show');
        return true;

    }

    public function create(User $user)
    {
        // logi('RecordsPolicy: create + store');
        return true;
    }

    public function update(User $user, $record)
    {
        // logi('RecordsPolicy: update + edit');
        return true;
    }

    public function delete(User $user, $record)
    {
        // logi('RecordsPolicy: delete');
        return true;
    }
}
```

### Policy Filter trait (for admins)

```php
namespace App\Policies\Traits;

/**
 * Trait RootPolicyFilter.
 */
trait RootPolicyFilter
{
    public function before($user, $ability)
    {
        // logi('before__'.$ability);
        // if ($user->isAdmin()) {
        //     return true;
        // }
    }
}
```

### Route Service Provider

`App\Providers\RouteServiceProvider.php`

```
...
public function boot()
{
    //

    parent::boot();

    Route::model('company', 'App\Models\Company');
    Route::model('user', 'App\Models\User');
}
```

#### Auth Service Provider

`App\Providers\AuthServiceProvider.php`

```
...
protected $policies = [
    'App\Models\Company' => 'App\Policies\RecordsPolicy',
];
```

#### Personalize resource param name

On your controller `__construct`, third parameter.

```
public function __construct(CompanyRepository $repo)
{
    $this->createInteraction = CompanyCreate::class;
    $this->updateInteraction = CompanyUpdate::class;

    parent::__construct('company', $repo, 'CONFIGURE_PARAM_NAME_HERE');
}
```

On base controller you should call:

```php
public function __construct($path, $repo, $param='')
{
    $this->authorizeResource($repo->model(), $param);  // this is the important line.
```
