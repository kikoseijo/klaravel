@extends('klaravel::layouts.crud')

@section('content')
    <div class="container -body-block pb-5">
        @card(['title' => 'Activity logs (all)'])
            {!! $logItems->render() !!}
            <div class="table-responsive">
                @includeIf('klaravel::admin.activitylog-table', ['iLogs' => $logItems])
            </div>
            {!! $logItems->render() !!}
        @endcard
    </div>
@endsection
