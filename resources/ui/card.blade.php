<div class="card {{$class or ''}}">
    @isset($title)
        <div class="card-header">{{$title}}</div>
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
