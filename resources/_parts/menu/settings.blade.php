@isset($settings_menu)
    @foreach ($settings_menu as $menuTitle => $menuItems)
        @component('klaravel::ui.dropdown', [
            'title' => $menuTitle,
            'active' => array_key_exists($croute, $menuItems)
        ])
        {{-- {{ dd($menuItems, $croute) }} --}}
            @foreach ($menuItems as $setUrl => $setLabel)
                <a href="{{ route($setUrl) }}" class="dropdown-item{{ $croute == $setUrl?' active':''}}">{{ $setLabel }}</a>
            @endforeach
        @endcomponent
    @endforeach
@endisset
