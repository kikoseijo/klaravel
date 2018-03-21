# Main menu

The main menu, as you can see on the code bellow, allows you to customize the navigation menu.
You can only overwrite this file if you have overwritten the header.

Notice the use of `{{$slot}}`, when included as a component.

```
@php
  // this param actives top level menu for dropdowns.  
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
            @include('klaravel::_parts.menu.klara')
            @include('klaravel::_parts.menu.user_dropdown')
        @endguest
    </ul>
</div>
```

#### Left side menu

Its the main navigation left side menu `klaravel::\_parts.menu.custom`, right side of the logo, you can have a dropdowns
using the label from the array key.

```
@isset($admin_menu)
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
@endisset
```

#### User Dropdown

```
@component('klaravel::ui.dropdown', [
    'title' => '<i class="far fa-user-circle"></i> ' . auth()->user()->name,
    'active' => 'ksoft' == $preroute || str_contains($croute, ['kSessions', 'kLogs', 'kCache', 'kBackup'])
])

    <a href="{{ route('ksoft.plugins.index') }}" class="dropdown-item{{ str_contains($croute, 'ksoft.plugins.index') ? ' active' : '' }}">Install plugin</a>
    @if (config('ksoft.module.activity_log.enabled'))
        <a href="{{ route('kLogs.index') }}" class="dropdown-item{{ str_contains($croute, 'kLogs') ? ' active' : '' }}">Activity Logs</a>
    @endif
    @if (config('ksoft.module.sessions.enabled'))
        <a href="{{ route('kSessions.index') }}" class="dropdown-item{{ str_contains($croute, 'kSessions') ? ' active' : '' }}">DB Sessions</a>
    @endif
    @if (config('ksoft.module.caches.enabled'))
        <a href="{{ route('kCache.index') }}" class="dropdown-item{{ str_contains($croute, 'kCache') ? ' active' : '' }}">DB Cache</a>
    @endif
    @if (config('ksoft.module.backup.enabled'))
        <a href="{{ route('kBackup.index') }}" class="dropdown-item{{ str_contains($croute, 'kBackup') ? ' active' : '' }}">Backups</a>
    @endif
    <div class="dropdown-divider"></div>
    <a class="dropdown-item" href="{{ route('logout') }}"
    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        Logout&nbsp;&nbsp;&nbsp;<span class="text-danger"><i class="far fa-sign-out-alt"></i></span>
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
@endcomponent
```

#### klaravel::\_parts.menu.klara

This submenu provides links to the wiki index, you can disable, make visible to desired developers id´s making adjustments of the configuration file.

```
'klaravel_enabled' => true,
'klaravel_visible_for' => [], // show menu only to users id`s (all by default)
'klaravel_route_name' => 'klaravel',
'klaravel_middleware' => ['web','auth'],
'show_integration_hints' => true, // points to wiki links.
```
