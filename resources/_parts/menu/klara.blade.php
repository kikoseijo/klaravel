@if (config('ksoft.klaravel_enabled'))
    <!-- klaravel::_parts.menu.klara -->

    @php
        $kAdmins = config('ksoft.klaravel_visible_for');
    @endphp
    @if (!is_array($kAdmins) || count($kAdmins) == 0 || (count($kAdmins) > 0 && in_array(auth()->id(), $kAdmins)))
        <li>
            <a class="nav-link mr-3" href="{{ route('kLara.index') }}">
                <img src="//sunnyface.com/images/klaravel.svg" width="24" alt="Dev. dashboard">
            </a>
        </li>
    @endif
@endif
