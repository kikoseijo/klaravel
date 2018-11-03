<!-- klaravel::ui.badge -->
<span class="badge badge-{{ $type }} {{ $class ?? '' }}{{ isset($pill) ? ' badge-pill' : ''}}">
    {{ $slot ?? '' }}{!! $title ?? '' !!}
</span>
