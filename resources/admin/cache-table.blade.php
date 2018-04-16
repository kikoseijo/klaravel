@isset($records)
    @if(count($records))
        <table class="{{config('ksoft.style.table_style')}}">
            <caption class="text-right">@includeIf('klaravel::ui.tables.count')</caption>
            <thead class="{{config('ksoft.style.thead')}}">
                <tr>
                    <th>Expire</th>
                    <th>Key</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($records as $record)
                    {{-- @php
                    $payload = unserialize(base64_decode($session->payload));
                    $ante = array_get($payload,'_previous');
                @endphp --}}
                <tr data-toggle="collapse" data-target="#collapse-{{$loop->index}}">

                    {{-- <td>{{ date('Y/m/d H:i', $record->expiration) }}</td> --}}
                    <td>{{ diff_date_for_humans(($record->expiration)) }}</td>

                    <td>{{ $record->key }}</td>

                    <td style="width:60px;" class="text-center">
                        <a href="{{ route('kCache.delete', $record->key) }}" class="btn btn-danger btn-sm">
                            <i class="far fa-trash-alt"></i>
                        </a>
                    </td>
                </tr>
                <tr id="collapse-{{$loop->index}}" class="row-fluid collapse in table-light">
                    <td class="text-muted py-4 px-5" colspan="4">
                        <code>{!! json_encode(cache($record->key)) !!}</code>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{-- <a href="{{ action('Back\ActivitylogController@index') }}">
    Ver todos los logs de actividad
</a> --}}
@else
    @includeif('klaravel::_parts.no-records')

@endif
@endisset
