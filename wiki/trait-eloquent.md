# Eloquent repository

Quick reference for a manual implementation.

#### Implementation

Create an empty repository Class that extends from `EloquentRepo`

```php
use Ksoft\Klaravel\Repositories\EloquentRepo;
use App\Models\User;

class UsersRepository extends EloquentRepo
{
  public function model()
  {
    return User::class;
  }
}
```

in your controller..

```php
use App\Repositories\UsersRepository;

class ExampleController extends Controller
{
    public function __construct(UsersRepository $repo)
    {
        $this->repo                 = $repo;
    }
```

you can do things like..

```php
$records = $this->repo->withPagination($request);
$records = $this->repo->findWhere('slug', $request->slug_value);
$record = $this->repo->findWhereFirst('slug', $request->slug_value);
```

#### available methods

```php
public function all();
public function find($id);
public function findWhere($column, $value);
public function findWhereFirst($column, $value);
public function findWhereLike($column, $value);
public function paginateIf($records, $per_page = 0);
public function create(array $properties);
public function update($id, array $properties);
public function delete($id);
```
