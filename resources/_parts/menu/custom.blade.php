@isset($admin_menu)
    <!-- klaravel::_parts.menu.custom -->

    @foreach ($admin_menu as $menuRoute => $menuLabel)
        @php
            $is_active_class = $croute == $menuRoute || in_array($preroute, explode('.',$menuRoute)) ? ' active':'';
        @endphp
        @if (is_array($menuLabel))

            @if (count($menuLabel) == 1)
                @php
                    $mLabel = collect($menuLabel)->keys()->first();
                    $singleLabel = str_contains($mLabel, 'fa-') ? '<i class="fa-fw '.$mLabel.'"></i>' : $mLabel;
                @endphp
                <li class="nav-item" role="presentation">
                    <a href="{{ route_has($menuRoute) }}"
                        class="nav-link{{ $is_active_class }}"
                        data-toggle="tooltip" title="{!! array_first($menuLabel) !!}">

                        {!! $singleLabel !!}
                    </a>
                </li>
            @else

                @component('klaravel::ui.dropdown', [
                    'title' => $menuRoute,
                    'class' => ' mx-2 ',
                    'active' => array_key_exists($croute, array_keys($menuLabel))
                ])
                    @foreach ($menuLabel as $subKey => $subValue)
                        @php
                        $selected = $menuRoute == $croute && request()->route('config_name') == $subKey ? ' active': '';
                        @endphp
                        <a href="{{ route_has($subKey) }}" class="dropdown-item{{ $selected}}">
                            {{$subValue}}
                        </a>
                    @endforeach
                @endcomponent

            @endif
        @else
            <li class="nav-item" role="presentation">
                <a href="{{ route_has($menuRoute) }}" class="nav-link{{ $is_active_class }}">
                    {!! $menuLabel !!} 
                </a>
            </li>
        @endif
    @endforeach
@endisset
