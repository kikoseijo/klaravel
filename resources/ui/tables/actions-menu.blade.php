<!-- klaravel::ui.tables.actions-menu -->
<nav class="navbar navbar-expand-md navbar-light bg-light">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#table-menu" aria-controls="table-menu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="table-menu">
      <ul class="navbar-nav mr-auto mt-2 mt-lg-0">

            @if (!isset($hide_add_menu))
                <li class="nav-item active mr-3">
                    <a href="{{ route_has($model_name.'.create') }}" data-toggle="tooltip" class="nav-link text-primary" title="Add New record">
                        <i class="far fa-plus fa-fw" aria-hidden="true"></i> Add new
                    </a>
                </li>
            @endif

            {{$slot ?? ''}}

            @if (!isset($hide_per_page))
                <li class="nav-item dropdown mr-3">
                    <a class="nav-link dropdown-toggle" title="Num. records per page" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                        <i class="far fa-table fa-fw mr-1" aria-hidden="true"></i> {{session(config('ksoft.CONSTANTS.take', 'PER_PAGE'))}}
                    </a>
                    <div class="dropdown-menu">
                        @foreach ([5, 10, 20, 50] as $perPage )
                            <a class="dropdown-item{{ session(config('ksoft.CONSTANTS.take', 'PER_PAGE')) == $perPage ? ' active' : ''}}"
                                href="{{route_has('swap-per-page')}}?perPage={{$perPage}}">
                                {{$perPage}}
                            </a>
                        @endforeach
                    </div>
            </li>
            @endif


        </ul>

        @if (!isset($hide_search))
            {!! Former::open()->method('GET')->route($model_name.'.index')->class('form-inline my-2 my-lg-0')->role('search')  !!}
                <div class="input-group">
                    <input type="text" class="form-control" name="q" placeholder="Search..." value="{{ request('q') }}">
                    <div class="input-group-append">
                      <button class="btn btn-outline-secondary" type="submit">
                        <i class="far fa-search fa-fw"></i>
                      </button>
                    </div>
                </div>
            {!! Former::close() !!}
        @endif

  </div>
</nav>
