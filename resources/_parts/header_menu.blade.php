@php
    $preroute = array_first(explode('.', $croute));
@endphp
<div class="collapse navbar-collapse" id="navbarHeader">

    <!-- Left Side Of Navbar -->
    <ul class="mr-auto navbar-nav top-left-menu">
        @auth
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
        @endauth
    </ul>

    <!-- Right Side Of Navbar -->
    <ul class="ml-auto navbar-nav top-right-menu">
        @guest
            <li><a class="nav-link" href="{{ route('login') }}">Login</a></li>
            <li><a class="nav-link" href="{{ route('register') }}">Register</a></li>
        @else
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
            @component('klaravel::ui.dropdown', [
                'title' => '<i class="far fa-user-circle"></i> ' . auth()->user()->name,
                'active' => 'ksoft' == $preroute || in_array($croute, ['kSessions', 'kLogs', 'kCache', 'kBackup'])
            ])

                <a href="{{ route('ksoft.plugins.index') }}" class="dropdown-item{{ str_contains($croute, 'ksoft.plugins.index') ? ' active' : '' }}">Install plugin</a>
                @if (auth()->user()->admin)
                    @if (config('ksoft.modules.activity_log.enabled'))
                        <a href="{{ route('kLogs.index') }}" class="dropdown-item{{ str_contains($croute, 'kLogs') ? ' active' : '' }}">Activity Logs</a>
                    @endif
                    @if (config('ksoft.modules.sessions.enabled'))
                        <a href="{{ route('kSessions.index') }}" class="dropdown-item{{ str_contains($croute, 'kSessions') ? ' active' : '' }}">DB Sessions</a>
                    @endif
                    @if (config('ksoft.modules.caches.enabled'))
                        <a href="{{ route('kCache.index') }}" class="dropdown-item{{ str_contains($croute, 'kCache') ? ' active' : '' }}">DB Cache</a>
                    @endif
                    @if (config('ksoft.modules.backup.enabled'))
                        <a href="{{ route('kBackup.index') }}" class="dropdown-item{{ str_contains($croute, 'kBackup') ? ' active' : '' }}">Backups</a>
                    @endif
                    <div class="dropdown-divider"></div>
                @endif
                <a class="dropdown-item" href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Logout&nbsp;&nbsp;&nbsp;<span class="text-danger"><i class="far fa-sign-out-alt"></i></span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            @endcomponent
        @endguest
    </ul>
</div>
