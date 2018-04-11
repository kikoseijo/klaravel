<!-- klaravel::ui.badge -->
<span class="badge badge-{{ $type }} {{ $class or '' }}{{ isset($pill) ? ' badge-pill' : ''}}">
    {{ $slot or '' }}{!! $title or '' !!}
</span>
