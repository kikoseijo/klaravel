@php
    $title = 'Plugins (kLaravel)';
@endphp

@extends(config('ksoft.module.crud.layout', 'klaravel::layouts.crud'))

@section('content')

    <div class="container">
        @component('klaravel::ui.alert', [
            'type' => 'danger',
        ])
            This section its not working right now, check back soon...
        @endcomponent
    </div>

    <div class="{{config('ksoft.style.crud_container_wrapper','container -body-block pb-5')}}">
        @foreach ($plugins as $key => $plugin)
            @card([
                'title' => $plugin['name'],
                'style' => 'width: 26rem;'
            ])
                <p class="card-text">
                    For more info please visit:<br />
                    <a href="{{$plugin['help_url']}}" target="_blank">
                        {!! $plugin['help_url'] !!}
                    </a>
                </p>
                @if (!class_exists($plugin['main_class']))
                    <a class="btn btn-primary" href="{{route('ksoft.plugins.install', $key)}}">
                        Install plugin
                    </a>
                @else
                    <a class="btn btn-danger" href="{{route('ksoft.plugins.uninstall', $key)}}">
                        Uninstall plugin
                    </a>

                @endif
            @endcard
        @endforeach
    </div>
@endsection
