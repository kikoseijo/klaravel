@extends('klaravel::layouts.crud')

@section('content')
    <div class="{{$crudWrapperClass}}">
        @card(['title' => 'Listing ' . title_case(str_plural($model_name))])
            @includeIf('klaravel::ui.tables.actions-menu')
            @if ($records->total()>0)
              @includeIf('klaravel::ui.tables.pagination')
              @includeIf($viewsBasePath.$model_name.'.table')
              {{$viewsBasePath.$model_name.'.table'}}
              @includeIf('klaravel::ui.tables.count')
            @endif
        @endcard
    </div>
@endsection
