@isset($settings_menu)
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
@endisset
