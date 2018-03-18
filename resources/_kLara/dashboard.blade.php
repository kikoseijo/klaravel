@extends('klaravel::layouts.app')

@section('content')
    <div class="container pb-4 mb-5">
        <div style="color:rgba(0,0,0,0.09);">
            <h1 class="display-4">Welcome {{ auth()->user()->name }},</h1>
        </div>

        <hr class="mb-4">
        @card(['title' => 'Klaravel control center', 'class' => 'mb-4'])

        @endcard

        <div class="row">
        <div class="col-sm-12">

            @card(['class' => 'mb-4'])
                <h5 class="card-title">Dev Utils</h5>
                <p class="card-text text-muted">
                    Common development trigger actions, under your responsability, of course.
                </p>
                {{-- <a href="{{route('settings.clean')}}" class="btn btn-secondary">Clean Settings</a>
                <a href="{{route('settings.flush')}}" class="btn btn-secondary">Flush Settings</a> --}}
                <a href="{{route('kLara.cache.flush')}}" class="btn btn-secondary">Flush DB Cache</a>
                <a href="{{route('kLara.bugsnag.test')}}" class="btn btn-secondary">Bugsnag error test</a>
                <a href="{{route('kLara.schedule.info')}}" class="btn btn-secondary">Schedule Info</a>
            @endcard
        </div>
    </div>
    </div>
@endsection
