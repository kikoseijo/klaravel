@extends('klaravel::layouts.crud')

@section('content')
    <div class="container -body-block pb-5">
        @card(['title' => 'Sessions table'])
            {!! $sessions->render() !!}
            @includeIf('klaravel::admin.active-users-table')
            {!! $sessions->render() !!}
        @endcard
    </div>
@endsection
