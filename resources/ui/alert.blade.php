<div class="alert alert-{{ $type or 'success' }}" role="alert">
    @isset($title)
        <h4 class="alert-heading">{{ $title }}</h4>
    @endisset
    {{ $slot }}
</div>
