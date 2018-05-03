<!-- klaravel::crud.index -->
@extends('klaravel::layouts.crud')

@section('content')
    <div class="{{$crudWrapperClass}}">
        @card(['title' => 'Listing ' . title_case(str_plural($model_name))])
        @includeIf('klaravel::ui.tables.actions-menu')
        @if ($records->total()>0)
            @includeIf('klaravel::ui.tables.pagination',['class'=> 'py-2 mt-2'])
            <div class="table-responsive-lg">
                <!-- {{$viewsBasePath.$model_name.'.table'}} -->
                @includeIf($viewsBasePath.$model_name.'.table')
            </div>
        @else
            @includeif('klaravel::_parts.no-records')
        @endif
        @endcard
    </div>
@endsection
