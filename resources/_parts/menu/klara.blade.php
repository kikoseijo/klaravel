@if (config('ksoft.klaravel_enabled'))
    @php($kAdmins = config('ksoft.klaravel_visible_for'))
    @if (!is_array($kAdmins) || count($kAdmins) == 0 || (count($kAdmins) > 0 && in_array(auth()->id(), $kAdmins)))
        @component('klaravel::ui.dropdown', [
            'title' => '<i class="fab fa-kickstarter text-primary"></i> ' ,
            'active' => str_contains($croute, ['kLara'])
        ])

            <a href="{{ route('kLara.index') }}"
            class="dropdown-item{{ $croute== 'kLara.index' ? ' active' : '' }}">
                Dashboard
            </a>
            <a href="{{ route('kLara.wiki', 'scaffold') }}" class="dropdown-item{{ request('section') == 'scaffold' ? ' active' : '' }}">
                Scaffold Generator
            </a>
            <a href="{{ route('kLara.wiki', 'traits') }}" class="dropdown-item{{ request('section') == 'traits' ? ' active' : '' }}">
                Traits
            </a>
            <a href="{{ route('kLara.wiki', 'components') }}" class="dropdown-item{{ request('section') == 'components' ? ' active' : '' }}">
                Components
            </a>
            <a href="{{ route('kLara.wiki', 'helpers') }}" class="dropdown-item{{ request('section') == 'helpers' ? ' active' : '' }}">
                Miscelaneous
            </a>

        @endcomponent

    @endif

@endif
