@extends('klaravel::layouts.crud')

@section('content')
    <div class="{{config('klaravel.style.crud_container_wrapper','container -body-block pb-5')}}">
        @card(['title' => 'Listing ' . title_case(str_plural($model_name))])
            @includeIf('klaravel::ui.tables.actions-menu')
            @if ($records->total()>0)
              @includeIf('klaravel::ui.tables.pagination')
              @includeIf(config('klaravel.modules.crud.views_base_path').'.'.$model_name.'.table')
              @includeIf('klaravel::ui.tables.count')
            @endif
        @endcard
    </div>
@endsection
