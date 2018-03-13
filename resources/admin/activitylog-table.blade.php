@isset($iLogs)
    @if(count($iLogs))
        <table class="{{config('ksoft.style.table_style')}}">
            <caption class="text-right">@includeIf('klaravel::ui.tables.count',['records' => $iLogs])</caption>
            <thead class="{{config('ksoft.style.thead')}}">
                <tr>
                    <th></th>
                    <th>Type</th>
                    <th>Model</th>
                    <th>Date</th>
                    <th>Activity</th>
                    <th>User</th>
                </tr>
            </thead>
            <tbody>
                @foreach($iLogs as $logItem)
                    <tr>
                        <td>
                            <a href="#ghogo" onclick="$('#table-row-{{$loop->index}}').toggle();">
                                <i class="far fa-chevron-right"></i>
                            </a>
                        </td>
                        <td>{!! $logItem->log_name !!}</td>
                        <td>{!! class_basename($logItem->subject_type) !!}</td>
                        <td>{{ $logItem->created_at->diffForHumans() }}</td>
                        <td>{!! $logItem->description !!}</td>
                        <td>
                            @if($logItem->causer)
                                {{ $logItem->causer->name }}
                            @endif
                        </td>
                    </tr>
                    <tr id="table-row-{{$loop->index}}" style="display:none">
                        <td colspan="6">
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
