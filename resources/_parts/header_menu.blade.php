<div class="collapse navbar-collapse" id="navbarHeader">

    <!-- Left Side Of Navbar -->
    <ul class="mr-auto navbar-nav">
        @auth
            @foreach ($menuItems as $menuRoute => $menuLabel)
                <li class="nav-item" role="presentation">
                    <a href="{{ route($menuRoute . '.index') }}" class="nav-link{{ starts_with($curUrl, $menuRoute.'.')?' active':''}}">{{ $menuLabel }}</a>
                </li>
            @endforeach
        @endauth
    </ul>

    <!-- Right Side Of Navbar -->
    <ul class="ml-auto navbar-nav">
        @guest
            <li><a class="nav-link" href="{{ route('login') }}">Login</a></li>
            <li><a class="nav-link" href="{{ route('register') }}">Register</a></li>
        @else
            @component('klaravel::ui.dropdown', ['title' => '<i class="fas fa-user-circle"></i> ' . auth()->user()->name ])
                @if (auth()->user()->admin)
                    <a href="{{ url('/user') }}" class="dropdown-item{{ starts_with($curUrl, 'users.')?' active':''}}">Users</a>
                    <a href="{{ url('/klogs') }}" class="dropdown-item{{ $curUrl == 'klogs' ? ' active' : '' }}">Activity Logs</a>
                    <a href="{{ url('/sessions') }}" class="dropdown-item{{ $curUrl == 'sessions' ? ' active' : '' }}">DB Sessions</a>
                    <a href="{{ url('/caches') }}" class="dropdown-item{{ $curUrl == 'caches' ? ' active' : '' }}">DB Cache</a>
                    <a href="{{ url('/backup') }}" class="dropdown-item{{ $curUrl == 'backup' ? ' active' : '' }}">Backups</a>
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
