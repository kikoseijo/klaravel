<!-- klaravel::_parts.footer -->
@php
    $gitVersion = trim(exec('git log --pretty="%h" -n1 HEAD'));
@endphp
<footer class="py-5 mb-3">
    <div class="container">
        <div class="footer__version">
            <img src="//sunnyface.com/images/klaravel.svg" style="width: 2.3em; margin-right: 12px; height: auto; vertical-align: middle;" alt="Klaravel by Sunnyface.com">
            <a href="https://github.com/kikoseijo/klaravel" data-toggle="tooltip" title="Laravel v{{ app()->version() }}" target="sunnyface">
                {{ config('app.name', 'Sunnyface.com Klaravel') }}
                <span>
                v{{ config('app.version', config('ksoft.version')) }}
                </span>
            </a>
            @if (config('ksoft.klaravel_enabled'))
                © <a href="{{route('kLara.index')}}" target="_blank">{{date('Y')}}</a>
            @else
                © {{date('Y')}}
            @endif

            @if(app()->environment() == 'production')
                <span class="badge badge-success px-2 ml-3">
                   <i class="fas fa-fw fa-fighter-jet mr-1"></i> Prod. <small>({{$gitVersion}})</small>
                </span>
            @else
                <span class="badge badge-warning px-2 ml-3">
                   <i class="fas fa-fw fa-wrench mr-1"></i> Dev <small>({{$gitVersion}})</small>
                </span>
            @endif
        </div>
        <div class="footer__credits">
            Made with <i class="far  fa-fw fa-heart text-danger pulse"></i> in Malaga, Spain.
            &nbsp;Created by
            <a href="http://kikoseijo.com" title="programador y diseñador de aplicaciones móviles en Málaga">
                Kiko Seijo
            </a>.
        </div>
    </div>
</footer>
