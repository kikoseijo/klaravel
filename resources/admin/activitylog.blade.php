@php
    $title = 'Activity logs (db)';
@endphp

@extends(config('ksoft.module.crud.layout', 'klaravel::layouts.crud'))

@section('content')
    <div class="{{config('ksoft.style.crud_container_wrapper','container -body-block pb-5')}}">
        @card([
            'title' => 'Activity logs (all)',
            'reload_btn' => true
        ])
            @component('klaravel::ui.tables.actions-menu', [
                'model_name' => 'kLogs',
                'hide_add_menu' => true,
            ])
                <li class="nav-item active mr-3">
                    <a href="{{ route('kLogs.index') }}" data-toggle="tooltip" class="nav-link text-primary" title="Clear all filters and reload">
                        <i class="far fa-eraser fa-fw mr-1"></i>
                    </a>
                </li>

                @component('klaravel::ui.dropdown', [
                    'title' => '<i class="far fa-filter fa-fw mr-1"></i> '. (request()->filled('tag') != ''
                                        ? model_title(request('tag'))
                                        : 'Filter by Type'),
                    'class' => '  mr-3'
                 ])
                    @foreach ($logsTags as $logsTag)
                        @php
                            $selected = request('tag') == $logsTag ? ' active': '';
                        @endphp
                        <a href="{{ route('kLogs.index') }}?tag={{$logsTag}}" class="dropdown-item{{ $selected}}">
                            {{$logsTag}}
                        </a>
                    @endforeach

                @endcomponent

                @component('klaravel::ui.dropdown', [
                    'title' => '<i class="far fa-filter fa-fw mr-1"></i> '. (request()->filled('subject')
                                        ? model_title(request('subject'))
                                        : 'Filter by subject'),
                    'class' => '  mr-3'
                 ])
                    @foreach ($logSubjects as $logSubject)
                        @php
                            $selected = request('subject') == $logSubject ? ' active': '';
                        @endphp
                        <a href="{{ route('kLogs.index') }}?subject={{$logSubject}}" class="dropdown-item{{ $selected}}">
                            {{$logSubject ?? '-'}}
                        </a>
                    @endforeach
                @endcomponent

                <li class="nav-item active mr-3">
                    <a href="#mass-delete" data-toggle="modal" data-target="#klaravel-logs-mass-delete" class="nav-link text-primary" title="Open mass purge dialog">
                        <i class="far fa-trash-alt fa-fw mr-1" aria-hidden="true"></i> Mass purge
                    </a>
                </li>
            @endcomponent

            <nav class="text-center align-middle mt-4">
                {!! $logItems->render() !!}
            </nav>
            <div class="table-responsive my-4">
                @includeIf('klaravel::admin.activitylog-table', ['iLogs' => $logItems])
            </div>
        @endcard
    </div>
@endsection

@push('modals')
    @component('klaravel::ui.modal', [
        'title' => 'Delete logs found using this filters query',
        'modalId' => 'klaravel-logs-mass-delete',
        'size' => 'lg'
    ])
        {!! Former::open()->route('kLogs.mass_delete')->id('klravel-logs-mass-destroy-modal-form') !!}

            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-5">
                        {!! Former::select('del_tag')->options($logsTags->toArray(), null, true)->label('Tags')->placeholder('Select by tags') !!}
                    </div>
                    @if ($logSubjects)
                        <div class="col-sm-2">
                            {!! Former::select('query_type')
                                ->options(['AND', 'OR'])
                                ->label('&nbsp;')
                            !!}
                        </div>
                        <div class="col-sm-5">
                            {!! Former::select('del_subject')->options($logSubjects->toArray(), null, true)->label('Subject')->placeholder('Select by subject') !!}
                        </div>
                    @endif
                </div>
                <div class="form-check my-4">
                    <input type="checkbox" class="form-check-input" id="clean_all" name="clean_all" value="yes">
                    <label class="form-check-label" for="clean_all">Delete all records from table</label>
                 </div>
            </div>
            <div class="modal-footer justify-content-center py-4">
                <button type="submit" class="btn btn-lg btn-danger">
                    <i class="far fa-exclamation-triangle fa-fw mr-2"></i>
                     Yes, delete. &nbsp;<small> (Procceed to precaution!)</small>
                </button>
            </div>
        {!! Former::close() !!}
    @endcomponent
@endpush
