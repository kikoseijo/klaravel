@extends('klaravel::layouts.crud')

@section('content')
    <div class="container -body-block pb-5">
        @card(['title' => 'Sessions table'])
            {!! $sessions->render() !!}
            <div class="table-responsive">
                @includeIf('klaravel::admin.active-users-table')
            </div>
            {!! $sessions->render() !!}
        @endcard
    </div>
@endsection
