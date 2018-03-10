@extends('klaravel::layouts.crud')

@section('content')

    @component('klaravel::ui.alert', [
        'type' => 'warning',
    ])
        This part of the package its under development. Stuck at installing with composer, help welcome.
    @endcomponent()

    <div class="container -body-block pb-5">
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
