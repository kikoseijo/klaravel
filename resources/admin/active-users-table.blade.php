@isset($sessions)
    @if(count($sessions))
        <table class="{{config('ksoft.style.table_style')}}">
            <thead class="{{config('ksoft.style.thead')}}">
                <tr>
                  <th></th>
                  <th>Last active</th>
                  <th>IP</th>
                  <th>Last visited page</th>
                  <th>Logged user</th>
                  <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($sessions as $session)
                    @php
                        $payload = unserialize(base64_decode($session->payload));
                        $ante = array_get($payload,'_previous');
                    @endphp
                    <tr>
                        <td>
                            <a href="#ghogo" onclick="$('#table-row-{{$loop->index}}').toggle();">
                                <i class="fas fa-chevron-right"></i>
                            </a>
                        </td>
                        <td>{{ date('d M H:i', $session->last_activity) }}</td>
                        <td>
                            <a href="http://geoiptool.com/en/?ip={{$session->ip_address}}" target="_blank">
                                {!! $session->ip_address !!}
                            </a>
                        </td>
                        <td>{{ isset($ante) ? $ante['url'] : ''}}</td>
                        <td>
                          @if($session->user_id)
                            {{-- <a href="{{ action('UserController@edit', $session->user_id) }}"> --}}
                              {{ $session->visitor->name }}
                            {{-- </a> --}}
                          @endif
                        </td>
                        <td style="width:60px;" class="text-center">
                            <a href="{{ route('kSessions.delete', $session->id) }}" class="btn btn-danger btn-sm">
                              <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <tr id="table-row-{{$loop->index}}" style="display:none">
                        <td class="text-muted" colspan="6">
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
