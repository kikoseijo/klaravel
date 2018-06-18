# Krud base layouts

This are reusable layouts for the krud component, them here for you if you need to overwrite them, just copy and paste
inside you component folder and the BaseKrudController will defaults to your files if found.

#### Table view

`index.blade.php`

```
@extends('klaravel::layouts.crud')

@section('content')
    <div class="{{$crudWrapperClass}}">
        @card(['title' => 'Listing ' . title_case(str_plural($model_name))])
        @includeIf('klaravel::ui.tables.actions-menu')
        @if ($records->total()>0)
            @includeIf('klaravel::ui.tables.pagination',['class'=> 'py-2 mt-2'])
            <div class="table-responsive-lg">
                @includeIf($viewsBasePath.$model_name.'.table')
            </div>
        @else
            @includeif('klaravel::_parts.no-records')
        @endif
        @endcard
    </div>
@endsection
```

#### Create view

`create.blade.php`

```
@extends('klaravel::layouts.crud')

@section('content')
    <div class="{{$crudWrapperClass}}">
        @card(['title' => 'New ' . title_case($model_name)])
            {!! Former::open_for_files()->route($model_name.'.store') !!}
            @includeIf($viewsBasePath.$model_name.'.form')
            {!! Former::close() !!}
        @endcard
    </div>
@endsection
```

#### Edit

`edit.blade.php`

```
@extends('klaravel::layouts.crud')

@section('content')
    <div class="{{$crudWrapperClass}}">
        @card()
            {!! Former::open_for_files()
                ->route($model_name . '.update', $record  )
                ->populate( $record )
            !!}
            @includeIf($viewsBasePath.$model_name.'.form', ['submitButtonText' => 'Update'])
            {!! Former::close() !!}
        @endcard
    </div>
@endsection
```

#### Additional tips

When you overwrite the views to customize to your needs you get extra capabilities, by using the Laravel Blade power engine
you can push pieces of code to your header and footer. Check out the Layout to see all possibilities.

This is just an use example, we adding animate.css to the header stylesheet stack, and swall to the footer scripts stack.

```
@push('stylesheets')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
@endpush
```

```
@push('scripts')
  <script type="text/javascript">
    $(document).ready(function() {
      swal("Hello world!");
    });
  </script>
@endpush
```

Explore the available components to have extra control on things like adding buttons
to tables using the `klaravel::ui.tables.actions`, adding dropdowns and buttons to `klaravel::ui.tables.actions-menu` you will benefit on doing less code and producing better quality and faster code development.

&nbsp;

Happy coding!
