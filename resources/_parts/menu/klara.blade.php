@if (config('ksoft.klaravel.enabled'))
    @component('klaravel::ui.dropdown', [
        'title' => '<i class="fab fa-kickstarter text-primary"></i> ' ,
        'active' => str_contains($croute, ['kLara'])
    ])

        <a href="{{ route('kLara.krud') }}"
        class="dropdown-item{{ $croute== 'kLara.krud' ? ' active' : '' }}">
            Krud
        </a>
        <a href="{{ route('kLara.components') }}"
        class="dropdown-item{{ $croute== 'kLara.components' ? ' active' : '' }}">
            Components
        </a>

    @endcomponent

@endif
