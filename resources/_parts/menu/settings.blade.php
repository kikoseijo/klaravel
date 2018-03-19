@isset($settings_menu)
    @if ($settings_menu_enabled)
        @foreach ($settings_menu as $menuTitle => $menuItems)
            @component('klaravel::ui.dropdown', [
                'title' => $menuTitle,
                'active' => is_array($menuItems) && array_key_exists($croute, $menuItems)
            ])
                @if (is_array($menuItems))
                    @foreach ($menuItems as $setUrl => $setLabel)
                        <a href="{{ route($setUrl) }}" class="dropdown-item{{ $croute == $setUrl?' active':''}}">{{ $setLabel }}</a>
                    @endforeach
                @endif
            @endcomponent
        @endforeach
    @endif
@endisset
