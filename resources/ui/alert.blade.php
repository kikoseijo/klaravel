<!-- klaravel::ui.alert -->
<div class="alert alert-{{ $type or 'success' }} {{$class or ''}}" role="alert">
    @isset($title)
        <h4 class="alert-heading">{{ $title }}</h4>
    @endisset
    {{ $slot or '' }}
</div>
