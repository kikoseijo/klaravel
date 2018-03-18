@php
    $preroute = array_first(explode('.', $croute));
@endphp
<div class="collapse navbar-collapse" id="navbarHeader">
    <ul class="mr-auto navbar-nav top-left-menu">
        @auth
            @include('klaravel::_parts.menu.custom')
            {{ $slot or ''}}
        @endauth
    </ul>
    <ul class="ml-auto navbar-nav top-right-menu">
        @guest
            <li><a class="nav-link" href="{{ route('login') }}">Login</a></li>
            <li><a class="nav-link" href="{{ route('register') }}">Register</a></li>
        @else
            @include('klaravel::_parts.menu.settings')

            <li>
                <a class="nav-link" href="{{ route('kLara.index') }}">
                    <i class="far fa-microchip text-success rm-3"></i>
                </a>
            </li>
            @include('klaravel::_parts.menu.user_dropdown')
        @endguest
    </ul>
</div>
