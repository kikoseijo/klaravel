@if (config('ksoft.klaravel.enabled'))
    @component('klaravel::ui.dropdown', [
        'title' => '<i class="fab fa-kickstarter text-primary"></i> ' ,
        'active' => str_contains($croute, ['kLara'])
    ])

        <a href="{{ route('kLara.index') }}"
        class="dropdown-item{{ $croute== 'kLara.index' ? ' active' : '' }}">
            Dashboard
        </a>
        <a href="{{ route('kLara.wiki', 'scaffold') }}"
        class="dropdown-item{{ request('section') == 'scaffold' ? ' active' : '' }}">
            Scaffold Generator
        </a>
        <a href="{{ route('kLara.wiki', 'traits') }}"
        class="dropdown-item{{ request('section') == 'traits' ? ' active' : '' }}">
            Traits
        </a>
        <a href="{{ route('kLara.wiki', 'components') }}"
        class="dropdown-item{{ request('section') == 'components' ? ' active' : '' }}">
            Components
        </a>

    @endcomponent

@endif
