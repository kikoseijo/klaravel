<!-- klaravel::ui.menu-nav -->
<nav class="navbar navbar-expand-md navbar-light bg-light">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#klravel-menu-nav" aria-controls="klravel-menu-nav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="klravel-menu-nav">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            {{$slot ?? ''}}
        </ul>
  </div>
</nav>
