<div class="card {{$class or ''}}">
    @isset($title)
        <div class="card-header">{{$title}}</div>
    @endisset
    <div class="card-body">
        {{ $slot }}
    </div>
</div>
