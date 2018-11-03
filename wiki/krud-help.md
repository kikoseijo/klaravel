# Scaffold procedure

At this point its recommended to have the Model and preferably some fake data populated. Its not provided by this
library, right now.

By running the Krud generator you will get a full working C.R.U.D. with lots of ready to use functionalities.

Lets start by creating our first Module by going to the generator and just enter the model name, in the example we used `Example` and files will be related to this name.

Note: After generating the crud add the `Route::resource` to your routes file.

```
Route::resource('example', 'ExampleControllers');
```

#### Controller

The controller extends from BaseKrudController, all methods can be overwritten on your main controller.
The field you probably adjust first its `$this->path` to match your route.

```php
class ExampleController extends BaseKrudController
{
    public function __construct(ExampleRepository $repo)
    {
        $this->createInteraction    = ExampleCreate::class;
        $this->updateInteraction    = ExampleUpdate::class;
        $this->repo                 = $repo;
        $this->path              = 'example';
    }
}
```

#### Interactions

Because complex applications are better when well structured, you will find 2 new files under `App\Interactions`
this files have very specific task, Create and Update records. Validation its called prior executing the database query.

**Make sure you define the validation rules on your model**

An alternative will be do define the logic in your controllers by overwriting the main resource methods.

#### Repository

This is the place where all database queries should be placed, filtering, ordering, etc. Table data queries are managed
in this file, this is what the function looks like:

```
public function withPagination($perPage, $request)
  {
      $query = $this->model::orderBy('id', 'desc');
      $qTerm = $request->filled('q') ? $request->get('q') : null;

      if ($qTerm) {
          $query->where('name', 'like', '%' . $qTerm . '%');
          foreach ($this->attrsFilter as $key) {
              $query->orWhere($key, 'like', '%' . $qTerm . '%');
          }
      }

      // logi($query->toSql());

      return $query->paginate($perPage);
  }
```

If you paid attention on your table view you probably noticed a search input area and pagination, them inputs are provided by a component `klaravel::ui.tables.actions-menu` and gives you a basic search point and this is where the logic its run.
You might extend this class to use the `QueryFiltersTrait` to have extra more power on query like date range

#### Views

After you have generated the Krud and provided the Resource on your routes, this is the place to continue building your application.
The `table.blade.php` provides you the starting point to have a basic table, you should only add the columns you need.
The `form.blade.php` its your view for creating and editing records, you only have to concentrate in adding the fields
on a nice layout of your choice using [Bootstrap4](https://getbootstrap.com/docs/4.0/layout/overview/) layout helpers.

#### Final tips

Every time you create a new Krud you will be working in the same main areas: your repository, your Interactions and the table + form view, this is where you concentrate all work, rest its magically done for you.

To have filters and advanced queries on models for your tables, concentrate work on the component repository, but you should also have your customized `index.blade.php` located in the same directory than the generated form and table blades. The file template for you to copy over your project its under the `Krud Reusable views` subject.

For modules that require a high level of customization you might end up having the 3 hidden base views overwritten, this is complete normal, you might use this library for backend and build the front using build tools like Vue.js ?? React.

For more advanced examples you can explore the additional modules in this library like backups, sessions ?? activity logs, then you will be able to see a working example on how complex task are made easy.

### Webpack

For the full scaffold using the production, you must extract vendors from js.

```
mix
  .js('resources/assets/js/app.js', 'public/js')
  .extract([
    'vue',
    'axios',
    'moment',
    'bootstrap',
    'element-ui',
    'jquery',
    'lodash',
    'popper.js',
    'vue-notifyjs'
  ])
  .sourceMaps();
```
