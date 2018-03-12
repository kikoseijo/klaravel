@extends('klaravel::layouts.crud')

@section('content')
    <div class="container -body-block pb-5">
        @card(['title' => 'Cache table'])
            {!! $records->render() !!}
            <div class="table-responsive">
                @includeIf('klaravel::admin.cache-table')
            </div>
            {!! $records->render() !!}
        @endcard
    </div>
@endsection
