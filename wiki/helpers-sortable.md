# Sortable

`composer require spatie/eloquent-sortable`

[https://github.com/spatie/eloquent-sortable](https://github.com/spatie/eloquent-sortable)

#### On the Model

```php
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class MyModel extends Eloquent implements Sortable
{
{

    use SortableTrait;

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
