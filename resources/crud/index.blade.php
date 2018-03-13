@extends('klaravel::layouts.crud')

@section('content')
    <div class="{{$crudWrapperClass}}">
        @card(['title' => 'Listing ' . title_case(str_plural($model_name))])
        @includeIf('klaravel::ui.tables.actions-menu')
        @if ($records->total()>0)
            @includeIf('klaravel::ui.tables.pagination',['class'=> 'py-4 mt-2 d-flex horizontal-align-middle align-center align-middle text-center'])
            <div class="table-responsive-lg">
                @includeIf($viewsBasePath.$model_name.'.table')
            </div>
        @else
            @includeif('klaravel::_parts.no-records')
        @endif
        mm
        @endcard
    </div>
@endsection
