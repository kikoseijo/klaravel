# Sortable

Add the pacakage to your composer by running `composer require spatie/eloquent-sortable`

[Additional documentation](https://github.com/spatie/eloquent-sortable), cheers Spatie.

#### Route

```
Route::get('MODEL_PATH_NAME/sort/{id}/{action?}', 'MODELController@sortRecord')->name('MODEL_PATH_NAME.sort');
```

#### Controller

```
use Ksoft\Klaravel\Traits\CanSortRecords;
```

#### Model

```php
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class MyModel extends Eloquent implements Sortable
{
{

    use SortableTrait;
    // IMPORTANT: next line to trigger table action buttons.
    public $sortable = [
        'order_column_name' => 'order_column',
        'sort_when_creating' => true,
    ];

    ...
}
```

#### What you can do...

```
$orderedRecords = MyModel::ordered()->get();
MyModel::setNewOrder([3,1,2]);
$myModel->moveOrderDown();
$myModel->moveOrderUp();
$myModel->moveToStart();
$myModel->moveToEnd();
```

More here [https://github.com/spatie/eloquent-sortable](https://github.com/spatie/eloquent-sortable)
