# The Footer

Use this template to overwrite your own implementation with small customizations.

```html
<footer class="py-5 mb-3">
  <div class="container">
    <div class="footer__version">
      <div class="footer__brand">
        {!! file_get_contents(KLARAVEL_PATH.'/../imgs/logo.svg') !!}
      </div>
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
        <span class="badge badge-success px-2">
          <i class="fas fa-fighter-jet mr-1"></i> Production
        </span>
      @else
        <span class="badge badge-warning px-2">
          <i class="fas fa-wrench mr-1"></i> Development
        </span>
      @endif
    </div>
    <div class="footer__credits">
      Made with <i class="far fa-heart text-danger pulse"></i> in Malaga, Spain.
      &nbsp;Created by
      <a href="http://kikoseijo.com" title="programador y diseñador de aplicaciones móviles en Málaga">
        Kiko Seijo
      </a>.
    </div>
  </div>
</footer>
```

#### Basic css

```css
footer {
  color: #6f6d70;
  font-size: 0.9em;
  a {
    color: #6f6d70;
  }
  .footer__version {
    float: left;
    text-align: left;
  }
  .footer__credits {
    float: right;
    text-align: center;
  }
  .footer__brand {
    width: 2.3em;
    margin-right: 12px;
    height: auto;
    vertical-align: middle;
  }
}

@media (max-width: 640px) {
  .footer__version {
    float: none;
  }
  .footer__credits {
    float: none;
  }
}
```
