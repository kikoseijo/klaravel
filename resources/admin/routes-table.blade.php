@if (count($routes))
    <table class="{{config('ksoft.style.table_style')}} table-sm">
        <thead class="thead-dark">
            <tr>
                <th></th>
                <th>uri</th>
                <th>action</th>
                <th>name</th>
                <th>middleware</th>
                <th>host</th>
            </tr>
        </thead>
        <tbody>
            @php
                $methods = [
                    'WILD' => 'GET|HEAD|POST|PUT|PATCH|DELETE|OPTIONS',
                    'GET' => 'GET|HEAD',
                    'PUT' => 'PUT|PATCH',
                ];
            @endphp
            @foreach($routes as $route)
                @php
                    $middleware = array_get($route, 'middleware');
                    $action = array_get($route, 'action');
                    $action_value = str_replace(array_values($methods), array_keys($methods), $route['method']);
                    $action_color = $action_value == 'GET' ? 'success' :
                        ($action_value == 'POST' ? 'warning' :
                        ($action_value == 'WILD' ? 'primary' : 'danger'));
                    $route_name = array_get($route, 'name');


                @endphp
                <tr>

                    <td class="text-center">@include('klaravel::ui.badge',['type' => $action_color, 'title'=> $action_value])</td>
                    <td>
                        <a href="{{ url($route['uri']) }}" target="_blank" class="small">
                            {{ $route['uri'] }}
                        </a>
                    </td>
                    <td><a href="#show" class="small" data-toggle="tooltip" title="{{$action}}">{{ isset($action) ? last(explode('\\', $action)) : '' }}</a></td>
                    <td><span class="small text-dark">{{ $route_name }}</span></td>
                    <td class="text-center">
                        @php
                            $middles = explode(',', $middleware);
                        @endphp
                        @foreach ($middles as $sMiddle)
                            @if (str_contains($sMiddle,':'))
                                @php
                                    $accumulated = $sMiddle;
                                @endphp
                                @continue
                            @endif
                            @php
                                if (isset($accumulated)) {
                                    $sMiddle=$accumulated.','.$sMiddle;
                                    unset($accumulated);
                                }
                            @endphp
                            {!! $loop->index >1 && str_contains($sMiddle,'\\') ? '<br />' : '' !!}
                            @include('klaravel::ui.badge',['type' => 'dark', 'title'=> $sMiddle ])

                        @endforeach
                    </td>
                    {{-- <td class="text-center">{{ isset($middleware) ? last(explode('\\', $middleware)) : '-' }}</td> --}}
                    <td>{{ $route['host'] }}</td>

                </tr>
            @endforeach
        </tbody>
    </table>
@else
    @includeif('klaravel::_parts.no-records', ['recrods_name' => 'backups'])
@endif
