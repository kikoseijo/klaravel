<footer class="my-5">
    <div class="container py-4">
        <p class="float-right">
            <a href="#">Go Top <i class="fas fa-level-up-alt"></i></a>
        </p>
        <p>
            <a href="https://github.com/kikoseijo/klaravel" data-toggle="tooltip" title="Laravel v{{ app()->version() }}" target="sunnyface">
                {{ config('app.name', 'Sunnyface.com Klaravel') }}
                <span>
                v{{ config('app.version', config('ksoft.version')) }}
                </span>
            </a>
                    © {{date('Y')}}
             @if(app()->environment() == 'production')
                 <span class="badge badge-success px-2">
                    <i class="fas fa-fighter-jet mr-1"></i> Production
                 </span>
             @else
                 <span class="badge badge-warning px-2">
                    <i class="fas fa-wrench mr-1"></i> Development
                 </span>
             @endif
        </p>
        <p>
            Made with <i class="far fa-heart text-danger pulse"></i> in Malaga, Spain.
            &nbsp;Created by
            <a href="http://kikoseijo.com" title="programador y diseñador de aplicaciones móviles en Málaga">
                Kiko Seijo
            </a>.
        </p>
    </div>
</footer>
