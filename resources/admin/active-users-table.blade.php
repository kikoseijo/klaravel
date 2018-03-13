@isset($sessions)
    @if(count($sessions))
        <table class="{{config('ksoft.style.table_style')}}">
            <caption class="text-right">@includeIf('klaravel::ui.tables.count',['records' => $sessions])</caption>
            <thead class="{{config('ksoft.style.thead')}}">
                <tr>
                    <th><i class="far fa-calendar-alt"></i></th>
                    <th>IP</th>
                    <th>Referer</th>
                    <th>Last page viewed</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($sessions as $session)
                    @php
                    $payload = unserialize(base64_decode($session->payload));
                    $ante = array_get($payload,'_previous');
                    $referer = array_get($payload,'referer');
                    $currentUrl = isset($ante) ? $ante['url'] : '';
                    @endphp
                    <tr data-toggle="collapse" data-target="#collapse-{{$loop->index}}">

                        <td>
                            {{ diff_date_for_humans($session->last_activity) }}
                        </td>
                        <td>
                            <a href="http://geoiptool.com/en/?ip={{$session->ip_address}}" data-toggle="tooltip" title="Ver el origen de la IP"  target="_blank">
                                {!! $session->ip_address !!}
                            </a>
                        </td>
                        <td>
                            @if ($referer)
                                <a href="{{ $referer}}" data-toggle="tooltip" title="{{$referer}}" target="_blank">
                                    <i class="far fa-external-link-square-alt"></i> {{str_limit(last(explode('/', $referer)),34)}}
                                </a>
                            @endif
                        </td>
                        <td>
                            @if ($currentUrl)
                                <div class="excerpt text-truncate" style="max-width:600px;">
                                    <a href="{{ $currentUrl}}" data-toggle="tooltip" title="{{$currentUrl}}" target="_blank">
                                        <i class="far fa-external-link-square-alt"></i>
                                    </a>
                                    {{ $currentUrl}}
                                </div>
                            @endif
                        </td>
                        <td class="text-center align-middle">
                            @if($session->user_id)
                                <a href="#tooltip" data-toogle="tooltip" title="{{ $session->visitor->name }}">
                                    <i class="far fa-users"></i>
                                </a>
                            @else
                                -
                            @endif
                        </td>
                        <td style="width:60px;" class="text-center align-middle">
                            <a href="{{ route('kSessions.delete', $session->id) }}" class="btn btn-danger btn-sm">
                                <i class="far fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <tr id="collapse-{{$loop->index}}" class="row-fluid collapse in table-light">
                        <td class="text-muted excerpt py-5 px-5"  colspan="6">
                            {!! $session->user_agent !!}
                            <hr>
                            <code>
                                {!! pretty_print_array($payload) !!}
                            </code>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{-- <a href="{{ action('Back\ActivitylogController@index') }}">
        Ver todos los logs de actividad
    </a> --}}
@else
    @includeif('klaravel::_parts.no-records', ['records_name' => 'Sessions'])
@endif
@endisset
