<!-- klaravel::_parts.header_menu -->
@php
    $preroute = array_first(explode('.', $croute));
@endphp
<div class="collapse navbar-collapse" id="navbarHeader">
    <ul class="mr-auto navbar-nav top-left-menu">
        @auth
            @include('klaravel::_parts.menu.custom')
            {{ $slot ?? ''}}
        @endauth
    </ul>
    <ul class="ml-auto navbar-nav top-right-menu">
        @guest
            <li><a class="nav-link" href="{{ route('login') }}">Login</a></li>
            <li><a class="nav-link" href="{{ route('register') }}">Register</a></li>
        @else
            @include('klaravel::_parts.menu.settings')
            @include('klaravel::_parts.menu.klara')
            @include('klaravel::_parts.menu.user_dropdown')
        @endguest
    </ul>
</div>
