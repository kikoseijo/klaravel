@isset($iLogs)
    @if(count($iLogs))
        <table class="{{config('ksoft.style.table_style')}}">
            <caption class="text-right">
                @includeIf('klaravel::ui.tables.count',[
                    'class' => 'text-muted',
                    'records' => $iLogs
                ])
            </caption>
            <thead class="{{config('ksoft.style.thead')}}">
                <tr>
                    <th>Type</th>
                    <th>Model</th>
                    <th>Date</th>
                    <th>Activity</th>
                    <th>User</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($iLogs as $logItem)
                    <tr data-toggle="collapse" data-target="#collapse-{{$loop->index}}">
                        <td>{!! $logItem->log_name !!}</td>
                        <td>{!! isset($logItem->subject_type) ? model_title($logItem->subject_type) :'-' !!}</td>
                        <td>{{ $logItem->created_at->diffForHumans() }}</td>
                        <td>{!! $logItem->description !!}</td>
                        <td>
                            @if($logItem->causer)
                                {{ $logItem->causer->name }}
                            @endif
                        </td>
                        <td class="text-center align-middle">
                            @component('klaravel::ui.button-group',['class' => 'btn-group-sm'])
                                <a href="{{ route('kLogs.delete', $logItem->id) }}" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash-alt fa-fw"></i>
                                </a>
                            @endcomponent
                        </td>
                    </tr>
                    <tr id="collapse-{{$loop->index}}" class="row-fluid collapse in table-light">
                        <td class="text-muted excerpt py-4 px-5"  colspan="6">
                            <code>@json($logItem)</code>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        @includeif('klaravel::_parts.no-records', ['recrods_name' => 'Activity logs'])
    @endif
@endisset
