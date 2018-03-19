# Repositories traits


##### QueryFiltersTrait

Extend eloquent queries of your repository, helps you search more in less time by defining some
groups of arrays.


```
use Ksoft\Klaravel\Traits\QueryFiltersTrait;
```

Example usage, on your repository class.

```
...
$this->query = '';
$this->attrsFilter = [
  'name', 'text', 'description', // as per your needs-...
];
...

public function withPagination($perPage, $request)
{
  $this->prepareQueryOrder($request);

  // Date range filter
  $this->applyDateRangeFilter($request, $field = 'dateRange', $attr = 'created_at'); // dateRange=[2012-12-1,2013-01-23]
  // or
  $this->applyDateSessionFilter($request, $attr = 'created_at');

  // String filters LIKE %{{keyword}}%
  $this->applyTiposFilters($request);
  $this->applySingleAttrsFilters($request); // fields to search declared in $this->attrsFilter
  // Same as before but you can find coincidences in multiple fields,
  $this->applyEqualTypeFilter($request, $itemsArray, $multiple = true);
  // boleans
  foreach (['active','published'] as $attr){
    $this->filterBool($attr, $value); // posibles $values: 0, 1 (and hardcoded) 'NULL', 'NOT_NULL'
  }

  return $this->query->paginate($perPage);
}


public function prepareQueryOrder($request)
{
  $savedOrder = session('order', 'newest');

  switch ($savedOrder) {
    case 'price_asc':
      $this->query = $this->model::orderBy('price', 'asc');
      break;
    case 'price_desc':
      $this->query = $this->model::orderBy('price', 'desc');
      break;
    default:
      $this->query = $this->model::orderBy('id', 'desc');
      break;
  }
}
```
