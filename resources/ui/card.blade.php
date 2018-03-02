<div class="card {{$class or ''}}">
    @isset($title)
        <div class="card-header">{{$title}}</div>
    @endisset
    @isset($langs)
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs" role="tablist">
                @php($i = 0)
                @foreach ($langs as $lang)
                    <li class="nav-item">
                        <a class="nav-link {{$i==0?' active':''}}"
                            href="#{{$lang}}"
                            data-toggle="tab"
                            role="tab"
                            aria-controls="{{$lang}}"
                            aria-selected="{{$i==0?'true':'false'}}">{{$lang}}</a>
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
