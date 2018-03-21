<div class="row">
    <div class="col-sm-3 mb-5">
        <ul class="nav flex-column px-0  border-right h-100" id="klara-tabs" role="tablist">
            @foreach ($mdMenu as $mdKey => $mdValue)
                <li class="nav-item">
                    <a class="nav-link py-2{{$mdKey==$mdActiveKey?' active':''}}" id="{{$section}}-{{$mdKey}}-tab" data-toggle="tab" href="#{{$section}}-{{$mdKey}}">{!! $mdValue !!}</a>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="col-sm-9">
        <div class="tab-content" id="klara-tabs">
            @foreach ($mdMenu as $mdKey => $mdValue)
                <div class="tab-pane fade{{$mdKey==$mdActiveKey?' show active':''}}" id="{{$section}}-{{$mdKey}}" role="tabpanel" aria-labelledby="{{$section}}-{{$mdKey}}-tab">
                    {!! do_markdown(file_get_contents(KLARAVEL_PATH . '/wiki/'.$section.'-'.$mdKey.'.md')) !!}
                </div>
            @endforeach
        </div>
    </div>
</div>
