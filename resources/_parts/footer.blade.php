<footer class="text-muted">
    <div class="container">
        <p class="float-right">
            <a href="#">Go Top <i class="far fa-level-up"></i></a>
        </p>
        <p>
            <a href="https://github.com/kikoseijo/klaravel" target="sunnyface">
                    {{ config('app.name', 'Sunnyface.com Klaravel') }} v<span title="Laravel v{{ app()->version() }}">{{ config('app.version') }}</span>
             © {{date('Y')}}
            @if(app()->environment() == 'production')
                    <span class="badge badge-success">
                        Production
                    </span>
               @else
                    <span class="badge badge-warning">
                        Development
                    </span>
               @endif
        </p>
        <p>
            Made with <i class="fa fa-heart text-danger pulse"></i> in Malaga, Spain.
            &nbsp;Created by
            <a href="http://kikoseijo.com" title="programador y diseñador de aplicaciones móviles en Málaga">
                Kiko Seijo
            </a>.
        </p>
    </div>
</footer>
