@extends('klaravel::layouts.app')

@section('content')
    <div class="container pb-4 mb-5">
        <div style="color:rgba(0,0,0,0.09);">
            <h1 class="display-4">Welcome {!! str_replace(' ', '&nbsp;', auth()->user()->name) !!},</h1>
        </div>
        @card(['title' => 'Klaravel control center', 'class' => 'mb-4 pb-4'])

            <div class="d-sm-flex justify-content-around py-4">
                <a href="{{route('kLara.wiki', 'scaffold')}}" class="btn d-block d-md-inline-block btn-lg btn-secondary mb-3">Scaffold Generator</a>
                <a href="{{route('kLara.wiki', 'components')}}" class="btn d-block d-md-inline-block btn-lg btn-secondary mb-3">Components</a>
                <a href="{{route('kLara.wiki', 'traits')}}" class="btn d-block d-md-inline-block btn-lg btn-secondary mb-3">Traits</a>
                <a href="{{route('kLara.menu')}}" class="btn d-block d-md-inline-block btn-lg btn-secondary mb-3">Menu manager</a>
            </div>
            {{-- @include('klaravel::_klara.panels.dashboard') --}}
        @endcard
    </div>
@endsection

{{--
@push('stylesheets')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/styles/atom-one-dark.min.css">
@endpush

@push('scripts')
    <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js"></script>
    <script>hljs.initHighlightingOnLoad();</script>
@endpush --}}
