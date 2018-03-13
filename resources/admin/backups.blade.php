@extends('klaravel::layouts.crud')

@section('content')
    <div class="{{config('ksoft.style.crud_container_wrapper','container -body-block pb-5')}}">
        @card(['title' => 'Backups'])
            @component('klaravel::ui.menu-nav')
                <li class="nav-item active mr-3">
                    <a href="{{ url($routeName.'/create') }}" class="nav-link text-primary" title="New backup">
                        <i class="far fa-plus" aria-hidden="true"></i> New backup
                    </a>
                </li>
            @endcomponent
            <div class="table-responsive my-4">
                @includeIf('klaravel::admin.backups-table')
            </div>
        @endcard
    </div>
@endsection
