# Table views components

This components provide an homogeneous style and additional functionality by extending reusable
components thanks to Laravel´s blade engine.

#### Record count for tables

```php
// Paginated records
@include('klaravel::ui.tables.count')
// Illuminate\Database\Query\Builder simple count.
@include('klaravel::ui.tables.count-query')
```

example usage:

```php
<table class="{{config('ksoft.style.table_style')}}">
    <caption class="text-right">@includeIf('klaravel::ui.tables.count')</caption>
    <thead class="thead-dark">
    ...
```

#### Table actions navigation bar

This component its build on top of [Boostrap4 Navbar](https://getbootstrap.com/docs/4.0/components/navbar/), add
more items using the slot component or plain with a single import.

```
@include('klaravel::ui.tables.actions-menu')
```

As a component, only `model_name` its mandatory due to components scope to enable **add new** or **search form** functionality.

```
@component('klaravel::ui.tables.actions-menu', [
  'model_name' => 'kLogs',
  'hide_add_menu' => false, // shown by default
  'hide_search' => false, // shown by default
  'hide_per_page' => false, // shown by default
])

  <li class="nav-item active mr-3">
      <a href="{{ route('kLogs.index') }}"
          data-toggle="tooltip"
          class="nav-link text-primary"
          title="Clear all filters and reload">
            <i class="far fa-eraser mr-1"></i>
      </a>
  </li>

  @component('klaravel::ui.dropdown', [
      'title' => '<i class="far fa-filter mr-1"></i> Title',
      'titleClass' => 'text-primary',
      'class' => '  mr-3'
   ])
      @foreach ($logsTags as $logsTag)
          @php
            $selected = request('tag') == $logsTag ? ' active': '';
          @endphp
          <a href="{{ route('kLogs.index') }}?tag={{$logsTag}}" class="dropdown-item{{ $selected}}">
              {{$logsTag}}
          </a>
      @endforeach
  @endcomponent

  <li class="nav-item active mr-3">
      <a href="#mass-delete" data-toggle="modal" data-target="#klaravel-logs-mass-delete" class="nav-link text-primary" title="Open mass purge dialog">
          <i class="far fa-trash-alt mr-1" aria-hidden="true"></i> Mass purge
      </a>
  </li>
@endcomponent
```

#### Table Row actions

With a simple include, you can still pass additional vars.

```
@include('klaravel::ui.tables.actions')
```

```php
<td style="{{$style or ''}}" class="align-middle text-center">
  <div class="btn-group{{isset($size)?' btn-group-'. $size:''}} klara-bt-group" role="group">

    <a href="{{ route_has($model_name.'.edit', $item->id) }}" data-toggle="tooltip" title="Edit record" class="btn btn-primary">
      <i class="far fa-edit" aria-hidden="true"></i>
    </a>

    {{$slot or ''}}

    @if (isset($item->sortable) && count($item->sortable)>0)
        @if (!isset($hide_sort))
            @include('klaravel::ui.tables.sort-dropdown')
        @endif
    @endif

    @include('klaravel::ui.tables.btn-delete')

  </div>
</td>
```

Delete button for table rows

```
@include('klaravel::ui.tables.btn-delete')
```

```php
<a class="btn btn-danger" data-toggle="tooltip" title="Delete record"
    onclick="event.preventDefault(); if (confirm('Confirm delete?')){ document.getElementById('delete-item-{{$item->id}}').submit();}"
    href="{{ route_has($model_name.'.index') }}">
  <i class="far fa-trash-alt" aria-hidden="true"></i>
</a>
<form id="delete-item-{{$item->id}}" action="{{ route_has($model_name.'.destroy', $item->id) }}" method="POST" style="display: none;">
    @csrf
    <input type="hidden" name="_method" value="delete" />
</form>

As a component its mandatory to pass down the `$record` reference and the `model_name`.
```

```php
@component('klaravel::ui.tables.actions', [
        'size' => 'sm',
        'style' => 'width:220px;', // tr style
        'model_name' => $model_name,
        'item' => $item
    ])
    <a href="mailto:{{$item->email}}" data-toggle="tooltip" title="Email {{$item->email}}" class="btn btn-primary text-white">
        <i class="far fa-paper-plane"></i>
    </a>
    <a href="tel:{{$item->phone}}" data-toggle="tooltip" title="Call {{$item->phone}}" class="btn btn-primary text-white">
        <i class="far fa-phone"></i>
    </a>
    <a href="#no.action" onclick="resendEmail({{$item->id}})" data-toggle="tooltip" title="Test Email for admin" class="btn btn-primary text-white">
        <i class="far fa-notes-medical"></i>
    </a>
@endcomponent
```

#### Pagination

The pagination element will look into `config('ksoft.module.crud.pagination_query_params')` to append
any existing query params found on actual request to the pagination links.

```
@includeIf('klaravel::ui.tables.pagination',['class'=> 'py-2 mt-2'])
```

```php
<!-- klaravel::ui.tables.pagination -->
<nav aria-label="Page navigation" class="{{ $class or '' }}">
    <?php $arrBase = config('ksoft.module.crud.pagination_query_params'); ?>
    {!! $records
        ->appends(array_combine($arrBase, array_map('request', $arrBase)))
        ->links()
    !!}
</nav>
```
