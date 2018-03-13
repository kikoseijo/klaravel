@extends('klaravel::layouts.crud')

@section('content')
    <div class="{{config('ksoft.style.crud_container_wrapper','container -body-block pb-5')}}">
        @card(['title' => 'Cache table'])
        <nav class="text-center align-middle">
            {!! $records->render() !!}
        </nav>
        <div class="table-responsive">
            @includeIf('klaravel::admin.cache-table')
        </div>

        @endcard
    </div>
@endsection
