<div class="card {{$class or ''}}">
    @isset($title)
        <div class="card-header">{{$title}}</div>
    @endisset
    @isset($tabs)
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs" role="tablist">
                @php($i = 0)
                @foreach ($tabs as $tab)
                    <li class="nav-item">
                        <a class="nav-link {{$i==0?' active':''}}"
                            href="#{{$tab}}"
                            data-toggle="tab"
                            role="tab"
                            aria-controls="{{$tab}}"
                            aria-selected="{{$i==0?'true':'false'}}">{{$tab}}</a>
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
