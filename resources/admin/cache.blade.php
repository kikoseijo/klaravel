@php
    $title = 'Caché configuration';
@endphp

@extends(config('ksoft.module.crud.layout', 'klaravel::layouts.crud'))

@section('content')
    <div class="{{config('ksoft.style.crud_container_wrapper','container -body-block pb-5')}}">
        @card(['title' => 'Cache table', 'reload_btn' => true])
        <nav class="text-center align-middle">
            {!! $records->render() !!}
        </nav>
        <div class="table-responsive">
            @includeIf('klaravel::admin.cache-table')
        </div>

        @endcard
    </div>
@endsection
