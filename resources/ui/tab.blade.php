<!-- klaravel::ui.tab -->
<ul class="nav nav-tabs {{$class ?? ''}}" role="tablist">
    @php
        $i = 0;
    @endphp
    @foreach ($tabs as $tabsKey => $tabsVal)
        <li class="nav-item">
            <a class="nav-link {{$i==0?' active':''}}"
                href="#{{$tabsKey}}"
                data-toggle="tab"
                role="tab"
                aria-controls="{{$tabsKey}}-tab"
                aria-selected="{{$i==0?'true':'false'}}">{!! $tabsVal !!}</a>
        </li>
        @php
            $i++;
        @endphp
    @endforeach
</ul>
<div class="tab-content p-3">
    {{ $slot ?? '' }}
</div>
