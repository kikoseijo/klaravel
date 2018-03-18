## Formers quick reference

&nbsp;  
For more detailed info visit [Formers Github](https://github.com/formers/former/wiki/)

#### Create record

```
{!! Former::open_for_files()->route($model_name.'.store') !!}
    {!! Former::text('name')->required()->label('Name') !!}
    @include('klaravel::ui.forms.textarea',[
        'name' => 'excerpt',
        'label' => 'Short description',
        'rows' => 2
    ])
    @include('klaravel::ui.forms.buttons')
{!! Former::close() !!}
```

#### Update record

```php
{!! Former::open_for_files()->route($model_name.'.store') !!}s
    {!! Former::text('name')->required()->label('Name') !!}
    @include('klaravel::ui.forms.textarea',[
        'name' => 'excerpt',
        'label' => 'Short description',
        'rows' => 2
    ])
    @include('klaravel::ui.forms.buttons')
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

```
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
