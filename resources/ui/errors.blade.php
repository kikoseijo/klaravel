<!-- klaravel::ui.errors -->
@includeIf('flash::message')
@isset($errors)
    @if ($errors->any())
        <div class="container">
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{-- <h5 class="alert-heading">Errores</h5>
                <hr /> --}}
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{!! $error !!}</li>
                    @endforeach
                </ul>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    @endif
@endisset
@if (session()->has('flash_message'))
    <div class="container">
        <div class="alert alert-success alert-dismissible fade show">
            {!! session()->get('flash_message') !!}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
@endif
@if (session()->has('flash_error'))
    <div class="container">
        <div class="alert alert-danger alert-dismissible fade show">
            {!! session()->get('flash_error') !!}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
@endif
