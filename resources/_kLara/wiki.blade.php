@extends('klaravel::layouts.app')
@php
    if ($section == 'layouts') {
        $mdMenu = [
            'header' => 'The Header',
            'footer' => 'The Footer',
            'menu' => 'Main menu',
            'settings' => 'Settings menu',
        ];
    }
@endphp
@section('content')
    <div class="container pb-4 mb-5">
        @card(['title' => 'Wiki - ' . title_case($section), 'class' => 'mb-4'])
            @if (isset($mdMenu))
                @include('klaravel::_kLara._parts.wiki-tabs',[
                    'section' => $section,
                    'mdActiveKey' => 'header',
                    'mdMenu' => $mdMenu,
                ])
            @else
                @include('klaravel::_klara.panels.'.$section)
            @endif
        @endcard
    </div>
@endsection


@push('stylesheets')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/styles/atom-one-dark.min.css">
@endpush

@push('scripts')
    <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js"></script>
    <script>hljs.initHighlightingOnLoad();</script>
@endpush
