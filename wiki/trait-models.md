# Models traits

##### ActiveScope

This trait works for easy filtering of eloquent calls. Import following trait in your model:

```
use Ksoft\Klaravel\Traits\ActiveScope;
```

You will be able to do things like:

```
$records = Post::active()->get(); // defaults to 'active' name of attribute
$records = Post::active('published')->get(); // specify the name.
$records = Post::active(['published','active'])->get(); // get active *AND* published records.
```

and..

```
$records = Post::notActive()->get();
```

##### HasLogs

Enable logs on your models, more info on [laravel-activitylog](https://docs.spatie.be/laravel-activitylog/v2/introduction)

```
use Ksoft\Klaravel\Traits\HasLogs;
```

```
activity('default')
  ->performedOn($anEloquentModel)
  ->causedBy($user)
  ->withProperties(['customProperty' => 'customValue'])
  ->log('Look mum, I logged something');
```


```
<?php
namespace Ksoft\Klaravel\Traits;
use Spatie\Activitylog\ActivitylogServiceProvider;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Relations\MorphMany;
/**
* Trait HasLogs.
*/
trait HasLogs
{
    use LogsActivity;
    protected static $recordEvents = ['deleted', 'created'];
    public function logs(): MorphMany
    {
        return $this->morphMany(
            ActivitylogServiceProvider::determineActivityModel(),
            'subject'
        )->orderBy('id', 'DESC');
    }
}
```
