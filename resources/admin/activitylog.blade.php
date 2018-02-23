@extends('klaravel::layouts.crud')

@section('content')
    <div class="container -body-block pb-5">
        @card(['title' => 'Activity logs (all)'])
            {!! $logItems->render() !!}
            @includeIf('klaravel::activitylog-table', ['iLogs' => $logItems])
            {!! $logItems->render() !!}
        @endcard
    </div>
@endsection
