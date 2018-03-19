@isset($admin_menu)
    @foreach ($admin_menu as $menuRoute => $menuLabel)
        @if (is_array($menuLabel))
            @component('klaravel::ui.dropdown', [
                'title' => title_case($menuRoute),
                'active' => array_key_exists($croute, array_keys($menuLabel))
            ])
            @foreach ($menuLabel as $subKey => $subValue)
                @php($selected = $menuRoute == $croute && request()->route('config_name') == $subKey ? ' active': '')
                <a href="{{ route($menuRoute, $subKey) }}" class="dropdown-item{{ $selected}}">
                    {{$subValue}}
                </a>
            @endforeach
        @endcomponent
    @else
        <li class="nav-item" role="presentation">
            <a href="{{ route($menuRoute) }}" class="nav-link{{ $croute == $menuRoute || str_contains($menuRoute, $preroute) ? ' active':''}}">{{ $menuLabel }}</a>
        </li>
    @endif
@endforeach
@endisset
