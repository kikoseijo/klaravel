@extends('klaravel::layouts.crud')

@section('content')
    <div class="container -body-block pb-5">
        @card(['title' => 'Backups'])
            @component('klaravel::ui.menu-nav')
                <li class="nav-item active mr-3">
                    <a href="{{ url($routeName.'/create') }}" class="nav-link text-primary" title="New backup">
                        <i class="far fa-plus" aria-hidden="true"></i> New backup
                    </a>
                </li>
            @endcomponent
            <div class="py-4"></div>
            @includeIf('klaravel::admin.backups-table')
            <div class="py-3"></div>
        @endcard
    </div>
@endsection
