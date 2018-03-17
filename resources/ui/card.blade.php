<div class="card {{$class or ''}}"{!! isset($style)? ' style="'.$style.'"':'' !!}>
    @isset($title)
        <div class="card-header">
            @if(!isset($hide_reload_btn))
                <a href="{{request()->fullUrl()}}"  data-toggle="tooltip" title="Reload current page" class="btn btn-sm d-inline-block btn-outline-primary float-right">
                    <i class="far fa-sync-alt"></i>
                </a>
            @endisset
            {{$title}}
        </div>
    @endisset
    @isset($tabs)
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs" role="tablist">
                @php($i = 0)
                @foreach ($tabs as $tabId => $tabLabel)
                    <li class="nav-item">
                        <a class="nav-link {{$i==0?' active':''}}"
                            href="#{{$tabId}}"
                            data-toggle="tab"
                            role="tab"
                            aria-controls="{{$tabId}}"
                            aria-selected="{{$i==0?'true':'false'}}">{{$tabLabel}}</a>
                    </li>
                    @php($i++)
                @endforeach
            </ul>
        </div>
    @endisset
    <div class="card-body">
        {{ $slot }}
    </div>
</div>
