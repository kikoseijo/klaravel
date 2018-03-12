@php
    $d_route = config('ksoft.backend_dashboard_route_name');
    $dashboard_url = $d_route != '' ? route($d_route) : url('/').'" target="_blank';
@endphp
<nav class="navbar navbar-expand-lg navbar-dark bg-dark box-shadow">
  <div class="d-flex justify-content-between container">
    <a href="{!!$dashboard_url!!}" class="m-auto brand-margin navbar-brand">
      <span>{{ config('app.name', 'Klaravel by Sunnyface.com')}}</span>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="true" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon" />
    </button>
    @include('klaravel::_parts.header_menu', [
        'admin_menu' => config('puntocero.menu.back'),
        'settings_menu' => config('puntocero.menu.settings'),
        'croute' => Route::currentRouteName()
    ])
  </div>
</nav>
