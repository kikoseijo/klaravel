@extends('klaravel::layouts.crud')

@section('content')
    <div class="{{config('ksoft.style.crud_container_wrapper','container -body-block pb-5')}}">
        @card(['title' => 'Backups'])
            @component('klaravel::ui.menu-nav')
                <li class="nav-item active mr-3">
                    <a href="{{ route('kBackup.create_db') }}" class="nav-link text-primary" title="New database backup">
                        <i class="far fa-database mr-1" aria-hidden="true"></i> New database backup
                    </a>
                </li>
                @if (config('ksoft.modules.backup.can_see_full_backups'))
                    <li class="nav-item active mr-3">
                        <a href="{{ route('kBackup.create_full') }}" class="nav-link text-primary" title="New full backup">
                            <i class="far fa-folder mr-1" aria-hidden="true"></i> New full backup
                        </a>
                    </li>
                @endif


            @endcomponent
            <div class="table-responsive my-4">
                @includeIf('klaravel::admin.backups-table')
            </div>
        @endcard
    </div>
@endsection
