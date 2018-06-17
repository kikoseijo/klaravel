@extends('klaravel::layouts.app')
@php
$dashMenu = [
   [
     "img" => "https://dummyimage.com/348x160/343a40/fff.png?text=C.R.U.D+Scaffold",
     "title" => "C.R.U.D Generator",
     "Text" => "Build your scaffold and find information regardin structure.",
     "link" => route('kLara.wiki', 'scaffold'),
   ],
   [
     "img" => "https://dummyimage.com/348x160/343a40/fff.png?text=Header+and+Menu",
     "title" => "Header, menu and footer layout",
     "Text" => "Ready to use header component explained in detail with sources.",
     "link" => route('kLara.wiki', 'layouts'),
   ],
   [
       "img" => "https://dummyimage.com/348x160/343a40/fff.png?text=How+to+-+Wiki",
       "title" => "Laravel Wiki & more",
       "Text" => "Configure DB, mailables, Passport, SEO, Localization, Seeds,..",
       "link" => route('kLara.wiki', 'helpers'),
   ],
   [
     "img" => "https://dummyimage.com/348x160/343a40/fff.png?text=The+Traits",
     "title" => "Reusable Traits",
     "Text" => "List of commonly used traits with instructions.",
     "link" => route('kLara.wiki', 'traits'),
   ],
   [
     "img" => "https://dummyimage.com/348x160/343a40/fff.png?text=Blade+components",
     "title" => "Blade Components",
     "Text" => "Ready to use components based on Bootstrap4 layouts.",
     "link" => route('kLara.wiki', 'components'),
   ],
   [
       "img" => "https://dummyimage.com/348x160/343a40/fff.png?text=Route::List",
       "title" => "List routes",
       "Text" => "A searchable list of all your defined routes.",
       "link" => route('kLara.routes.index'),
   ],
   [
     "img" => "https://dummyimage.com/348x160/343a40/fff.png?text=Developer+tools",
     "title" => "Developer utils",
     "Text" => "Flush settings, cache, test bugsnag, more to come..",
     "link" => route('kLara.wiki', 'utils'),
   ],
 ];
@endphp

@section('content')
    <div class="container pb-4 mb-5">
        <div style="color:rgba(0,0,0,0.09);">
            <h1 class="display-4">Welcome {!! str_replace(' ', '&nbsp;', auth()->user()->name) !!},</h1>
        </div>


        <div class="row mt-5">
            @foreach ($dashMenu as $dashKey => $dashValue)
                <div class="col-md-4">
                    <div class="card mb-4 box-shadow">
                        <a href="{!! $dashValue["link"] !!}">
                            <img class="card-img-top" src="{!! $dashValue["img"] !!}" title="{!! $dashValue["title"] !!}" class="d-block" style="height: 160px; width: 100%;">
                        </a>
                        <div class="card-body">
                            <p class="card-text">
                                {!! nl2br($dashValue["Text"]) !!}
                                <a href="{!! $dashValue["link"] !!}" class="ml-1">
                                    <i class="fas fa-fw fa-chevron-right ml-1"></i>
                                    <i class="fas fa-fw fa-chevron-right ml-1"></i>
                                    <i class="fas fa-fw fa-chevron-right ml-1"></i>
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
        <div class="clearfix"></div>

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
