@extends('klaravel::layouts.app')

@section('content')
    <div class="container pb-4 mb-5">
        @card(['title' => 'Wiki - ' . title_case($section), 'class' => 'mb-4'])
            @include('klaravel::_klara.panels.'.$section)
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
