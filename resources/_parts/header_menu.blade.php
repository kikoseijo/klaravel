<div class="collapse navbar-collapse" id="navbarHeader">

    <!-- Left Side Of Navbar -->
    <ul class="mr-auto navbar-nav">
        @auth
            @foreach ($admin_menu as $menuRoute => $menuLabel)
                @if (is_array($menuLabel))
                    @component('klaravel::ui.dropdown', ['title' => title_case($menuRoute) ])
                        @foreach ($menuLabel as $subKey => $subValue)
                            <a href="{{ route($menuRoute.'.index', $subKey) }}" class="dropdown-item{{ starts_with($currrent_route_name, $subKey.'.')?' active':''}}">{{$subValue}}</a>
                        @endforeach
                    @endcomponent
                @else
                    <li class="nav-item" role="presentation">
                        <a href="{{ route($menuRoute . '.index') }}" class="nav-link{{ starts_with($currrent_route_name, $menuRoute.'.')?' active':''}}">{{ $menuLabel }}</a>
                    </li>
                @endif
            @endforeach
        @endauth
    </ul>

    <!-- Right Side Of Navbar -->
    <ul class="ml-auto navbar-nav">
        @guest
            <li><a class="nav-link" href="{{ route('login') }}">Login</a></li>
            <li><a class="nav-link" href="{{ route('register') }}">Register</a></li>
        @else
            @isset($settings_menu)
                @component('klaravel::ui.dropdown', ['title' => '<i class="fas fa-cogs"></i>' ])
                    @foreach ($settings_menu as $setUrl => $setLabel)
                        <a href="{{ url($setUrl) }}" class="dropdown-item{{ $currrent_route_name == $setUrl?' active':''}}">{{ $setLabel }}</a>
                    @endforeach
                @endcomponent
            @endisset
            @component('klaravel::ui.dropdown', ['title' => '<i class="fas fa-user-circle"></i> ' . auth()->user()->name ])
                @if (auth()->user()->admin)
                    @if (config('ksoft.modules.activity_log.enabled'))
                        <a href="{{ route('kLogs') }}" class="dropdown-item{{ $currrent_route_name == 'klogs' ? ' active' : '' }}">Activity Logs</a>
                    @endif
                    @if (config('ksoft.modules.sessions.enabled'))
                        <a href="{{ route('kSessions') }}" class="dropdown-item{{ $currrent_route_name == 'sessions' ? ' active' : '' }}">DB Sessions</a>
                    @endif
                    @if (config('ksoft.modules.caches.enabled'))
                        <a href="{{ route('kCache') }}" class="dropdown-item{{ $currrent_route_name == 'caches' ? ' active' : '' }}">DB Cache</a>
                    @endif
                    @if (config('ksoft.modules.backup.enabled'))
                        <a href="{{ route('kBackup') }}" class="dropdown-item{{ $currrent_route_name == 'backup' ? ' active' : '' }}">Backups</a>
                    @endif
                    <div class="dropdown-divider"></div>
                @endif
                <a class="dropdown-item" href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Logout&nbsp;&nbsp;&nbsp;<span class="text-danger"><i class="fas fa-sign-out-alt"></i></span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            @endcomponent
        @endguest
    </ul>
</div>
