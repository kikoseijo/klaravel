<figure class="figure {{ $class or '' }}">
    {{ $slot or '' }}

    @isset($caption)
        <figcaption class="figure-caption">{!! $caption !!}</figcaption>
    @endisset
</figure>
