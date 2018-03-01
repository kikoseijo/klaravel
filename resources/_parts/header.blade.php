<nav class="navbar navbar-expand-lg navbar-dark bg-dark box-shadow">
  <div class="d-flex justify-content-between container">
    <a href="/home" class="m-auto brand-margin navbar-brand">
      <span>HMDP</span>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="true" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon" />
    </button>
    @include('back._parts.header_menu', [
        'menuItems' => config('molino.admin_menu')
    ])
  </div>
</nav>
