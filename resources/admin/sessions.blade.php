@php
    $title = 'Activity sessions (kLaravel)';
@endphp

@extends(config('ksoft.module.crud.layout', 'klaravel::layouts.crud'))

@section('content')
    <div class="{{config('ksoft.style.crud_container_wrapper','container -body-block pb-5')}}">
        @card(['title' => 'Latest site visitors', 'reload_btn' => true])

            @component('klaravel::ui.tables.actions-menu', [
                'model_name' => 'kSessions',
                'hide_add_menu' => true,
                'hide_search' => true,
            ])
                <li class="nav-item active mr-3">
                    <a href="{{ route('kSessions.index') }}?limit=X" data-toggle="tooltip" class="nav-link text-primary" title="Clear all filters and reload">
                        <i class="far fa-eraser mr-1  fa-fw"></i>
                    </a>
                </li>
                @php
                    $tLimit = session(SESSION_TIME_LIMIT_CACHE);
                @endphp
                @component('klaravel::ui.dropdown', [
                    'title' => '<i class="far fa-clock fa-fw mr-1"></i> '. ($tLimit ?: 'No time limit'),
                    'class' => '  mr-3',
                    'active' => $tLimit != '',
                 ])

                    @foreach (['5-m','15-m','30-m','1-h', '3-h','8-h','12-h','24-h'] as $curTime)
                        @php
                            $selected = $tLimit == $curTime ? ' active': '';
                            $carst = explode('-',$curTime);
                        @endphp
                        <a href="{{ route('kSessions.index') }}?limit={{$curTime}}" class="dropdown-item{{ $selected}}">
                            {{$carst[0] . $carst[1]}}
                        </a>
                    @endforeach

                @endcomponent


            @endcomponent

            <nav class="text-center align-middle mt-4">
                {!! $sessions->render() !!}
            </nav>

            <div class="table-responsive my-4">
                @includeIf('klaravel::admin.sessions-table')
            </div>
        @endcard
    </div>
@endsection
