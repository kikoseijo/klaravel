@extends('klaravel::layouts.crud')

@section('content')
    <div class="{{config('ksoft.style.crud_container_wrapper','container -body-block pb-5')}}">
        @card(['title' => 'Sessions table'])
            <nav class="text-center align-middle">
                {!! $sessions->render() !!}
            </nav>
            <div class="table-responsive my-4">
                @includeIf('klaravel::admin.active-users-table')
            </div>
        @endcard
    </div>
@endsection
