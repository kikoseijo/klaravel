@extends('klaravel::layouts.crud')

@section('content')
    <div class="{{config('ksoft.style.crud_container_wrapper','container -body-block pb-5')}}">
        @card(['title' => 'Activity logs (all)'])
            <nav class="text-center align-middle">
                {!! $logItems->render() !!}
            </nav>
            <div class="table-responsive">
                @includeIf('klaravel::admin.activitylog-table', ['iLogs' => $logItems])
            </div>
        @endcard
    </div>
@endsection
