@extends('klaravel::layouts.crud')

@section('content')
    <div class="{{config('klaravel.style.crud_container_wrapper','container -body-block pb-5')}}">
        @card(['title' => 'New ' . title_case($model_name)])
            {!! Former::open()->route($model_name.'.store') !!}
            @includeIf(config('klaravel.modules.crud.views_base_path').'.'.$model_name.'.form')
            {!! Former::close() !!}
        @endcard
    </div>
@endsection
