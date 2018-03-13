@isset($sessions)
    @if(count($sessions))
        <table class="{{config('ksoft.style.table_style')}}">
            <thead class="{{config('ksoft.style.thead')}}">
                <tr>
                  <th></th>
                  <th>Last active</th>
                  <th>IP</th>
                  <th>Referer</th>
                  <th>Last visited page</th>
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
                    <tr>
                        <td>
                            <a href="#ghogo" onclick="$('#table-row-{{$loop->index}}').toggle();">
                                <i class="far fa-chevron-right"></i>
                            </a>
                        </td>
                        <td>{{ date('d M H:i', $session->last_activity) }}</td>
                        <td>
                            <a href="http://geoiptool.com/en/?ip={{$session->ip_address}}" target="_blank">
                                {!! $session->ip_address !!}
                            </a>
                        </td>
                        <td>
                            @if ($referer)
                                <a href="{{ $referer}}" data-toggle="tooltip" data-placement="right" title="{{$referer}}" target="_blank">
                                    <i class="far fa-external-link-square-alt"></i> {{str_limit(last(explode('/', $referer)),34)}}
                                </a>
                            @endif
                        </td>
                        <td>
                            @if ($currentUrl)
                                <a href="{{ $currentUrl}}" data-toggle="tooltip" data-placement="right" title="{{$currentUrl}}" target="_blank">
                                    <i class="far fa-external-link-square-alt"></i> /{{str_limit(last(explode('/', $currentUrl)),32)}}
                                </a>
                            @endif
                        </td>
                        <td>
                          @if($session->user_id)
                              {{ $session->visitor->name }}
                          @else
                              Invitado
                          @endif
                        </td>
                        <td style="width:60px;" class="text-center">
                            <a href="{{ route('kSessions.delete', $session->id) }}" class="btn btn-danger btn-sm">
                              <i class="far fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <tr id="table-row-{{$loop->index}}" style="display:none">
                        <td class="text-muted" colspan="7">
                            {!! $session->user_agent !!}
                            <hr>
                            <code>{!! json_encode($payload) !!}</code>
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
