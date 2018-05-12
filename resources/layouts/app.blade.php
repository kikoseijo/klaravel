<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
@includeIf('parts.hiddenCredits')
<!-- app.blade.php -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Klaravel, by Sunnyface.com</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    @include('klaravel::_kLara._parts._styles')
    @foreach (config('ksoft.module.crud.assets', []) as $useAssets)
       <link href="{{ asset($useAssets) }}" rel="stylesheet">
    @endforeach
    @stack('stylesheets')
    <script>
        window.Larapp = {!! json_encode([
            'csrfToken' => csrf_token(),
            'state' => ['user' => Auth::user()],
        ]) !!};
        @stack('js')
    </script>
</head>
<body>
    <div id="app" class="klara-wrapper">
        @includeIf(config('ksoft.module.crud.header', 'klaravel::_parts.header'))
        <div class="album py-5 bg-light klara-content">
            @includeIf(config('ksoft.module.crud.errors', 'klaravel::ui.errors'))

            @yield('content')
        </div>
        @includeIf(config('ksoft.module.crud.footer', 'klaravel::_parts.footer'))
        @stack('modals')
        <notifications></notifications>

    </div>
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    @stack('scripts')
    @include('klaravel::_kLara._parts._scripts')

</body>
</html>
