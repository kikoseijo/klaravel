@extends('klaravel::layouts.crud')

@section('content')
    <div class="container -body-block pb-5">
        @card(['title' => 'Cache table'])
            {!! $records->render() !!}
            @includeIf('klaravel::admin.cache-table')
            {!! $records->render() !!}
        @endcard
    </div>
@endsection
