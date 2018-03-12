<nav class="navbar navbar-expand-lg navbar-dark bg-dark box-shadow">
  <div class="d-flex justify-content-between container">
    <a href="/" target="_blank" class="m-auto brand-margin navbar-brand">
      <span>Klara</span>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="true" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon" />
    </button>
    @include('klaravel::_parts.header_menu', [
        'admin_menu' => config('aplication.menu.back'),
        'settings_menu' => config('aplication.menu.settings'),
        'croute' => Route::currentRouteName()
    ])
  </div>
</nav>
