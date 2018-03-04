

<ul class="nav nav-tabs bg-light  {{$class or ''}}" role="tablist">
    @php($i = 0)
    @foreach ($tabs as $tabsKey => $tabsVal)
        <li class="nav-item">
            <a class="nav-link {{$i==0?' active':''}}"
                href="#{{$tabsKey}}"
                data-toggle="tab"
                role="tab"
                aria-controls="{{$tabsKey}}-tab"
                aria-selected="{{$i==0?'true':'false'}}">{!! $tabsVal !!}</a>
        </li>
        @php($i++)
    @endforeach
</ul>
<div class="tab-content p-3 bg-white border border-top-0">
    {{ $slot }}
</div>
