@if(isset($settings_menu) && isset($settings_menu_enabled))
    <!-- klaravel::_parts.menu.settings -->
    @if ($settings_menu_enabled)
        @foreach ($settings_menu as $menuTitle => $menuItems)
            @if (is_array($menuItems))
                @component('klaravel::ui.dropdown', [
                    'title' => $menuTitle,
                    'active' => is_array($menuItems) && array_key_exists($croute, $menuItems)
                ])
                        @foreach ($menuItems as $setUrl => $setLabel)
                            <a href="{{ route_has($setUrl) }}" class="dropdown-item{{ $croute == $setUrl?' active':''}}">{{ $setLabel }}</a>
                        @endforeach
                @endcomponent
            @else
                <li class="nav-item">
                    <a href="{{ route_has($menuItems) }}" class="nav-link{{ $croute == $menuItems?' active':''}}">
                        {!! $menuTitle !!}
                    </a>
                </li>
            @endif
        @endforeach
    @endif
@else
    @if (config('ksoft.show_integration_hints'))
        <!-- klaravel::_parts.menu.settings -->
        <li class="nav-item">
            <a href="{{route('kLara.wiki','layouts')}}#layouts-settings" class="nav-link" data-toggle="tooltip" title="Enable settings menu">
                <i class="far fa-cogs fa-fw text-info"></i>
            </a>
        </li>
    @endif
@endif
