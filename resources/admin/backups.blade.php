@php
    $title = 'Backups (db + filesystem)';
@endphp
@extends(config('ksoft.module.crud.layout', 'klaravel::layouts.crud'))

@section('content')
    <div class="{{config('ksoft.style.crud_container_wrapper','container -body-block pb-5')}}">
        @card(['title' => 'Backups', 'reload_btn' => true])
            @component('klaravel::ui.menu-nav')
                <li class="nav-item active mr-3">
                    <a href="{{ route('kBackup.create_db') }}" data-toggle="tooltip" class="nav-link text-primary" title="New database backup">
                        <i class="far fa-database fa-fw mr-1" aria-hidden="true"></i> Database backup
                    </a>
                </li>
                @if (config('ksoft.module.backup.can_see_full_backups'))
                    <li class="nav-item active mr-3">
                        <a href="{{ route('kBackup.create_full') }}"
                            data-toggle="tooltip"
                            class="nav-link text-primary"
                            title="New full backup using config(ksoft.modules.backup.extra_arguments) configuration">
                            <i class="far fa-folder fa-fw mr-1" aria-hidden="true"></i> Full backup
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
