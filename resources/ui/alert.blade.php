<!-- klaravel::ui.alert -->
<div class="alert alert-{{ $type ?? 'success' }} {{$class ?? ''}}" role="alert">
    @isset($title)
        <h4 class="alert-heading">{{ $title }}</h4>
    @endisset
    {{ $slot ?? '' }}
</div>
