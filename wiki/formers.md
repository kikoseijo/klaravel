## Formers quick reference

&nbsp;  
For more detailed info visit [Formers Github](https://github.com/formers/former/wiki/)

#### Configuration

Publish the configuration file:

```bash
php artisan vendor:publish --provider="Former\FormerServiceProvider"
```

Adjust configuration file `config/former.php` with the following information: **this is due to bootstrap4 not being a framework available right now** i got yo covered...

```
...
// The framework to be used by Former
'framework' => 'Ksoft\Klaravel\Utils\FormerBootstrap4',
...
// Width of labels for horizontal forms expressed as viewport => grid columns
'labelWidths' => array(
  'large' => 2,
  'small' => 10,
),
...
```

Checkboxes and radios having issues with alignments, use the components or by hand...

#### Create record

```php
{!! Former::open_for_files()
  ->route($model_name.'.store')
!!}
  ...
  {!! Former::text('name')->required()->label('Name') !!}
  @include('klaravel::ui.forms.textarea',[
    'name' => 'excerpt',
    'label' => 'Short description',
    'rows' => 2
  ])
  ...
  @include('klaravel::ui.forms.buttons')
{!! Former::close() !!}
```

#### Update record

```php
{!! Former::open_for_files()
    ->route($model_name . '.update', $record->id  )
    ->populate( $record )
!!}
  ...
  {!! Former::text('name')->required()->label('Name') !!}
  @include('klaravel::ui.forms.textarea',[
    'name' => 'excerpt',
    'label' => 'Short description',
    'rows' => 2
  ])
  ...
  @include('klaravel::ui.forms.buttons', ['submitButtonText' => 'Update record'])
{!! Former::close() !!}
```

#### Select fromQuery

```php
{!! Former::select('post_id')
  ->fromQuery(App\Models\Post::orderBy('name','asc')->get(), 'name', 'id')
  ->required()
  ->placeholder('Select...')
  ->label('Post')
!!}
```

#### Select options

```php
{!! Former::select('post_id')
  ->options(['Option 1', 'Option 2'], null, true)
  ->placeholder('Select...')
  ->label('Post')
!!}
```

```php
{!! Former::select('rating')
    ->options(array_combine(range(1,5),range(1,5)))
    ->label('Rating')
    ->placeholder('Select rating')
!!}
```

#### Radio buttons

This is a temporary fix due to Formers being outdated at the moment.

```php
@include('klaravel::ui.forms.radios',[
    'items' => ['1' => 'Yes', '0' => 'No'],
    'label' => 'Record active',
    'name' => 'active',
    'value' => isset($record) ? $record->active : '',
])
```

#### Textarea

```
@include('klaravel::ui.forms.textarea',[
    'name' => 'excerpt',
    'label' => 'Short description',
    'rows' => 2
])
```

#### files

```
{!! Former::file('img')
    ->label('Slider image')
    ->accept('image/jpeg', 'image/png')
    ->help('Recommended image size 1600x840 px.')
!!}
```

#### Form buttons

```
@include('klaravel::ui.forms.buttons')
```
