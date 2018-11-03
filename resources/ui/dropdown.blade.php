<!-- klaravel::ui.dropdown -->
<?php $curMenuId = isset($curMenuId) ? $curMenuId : 'drop-down-'.rand(10000,1111222); ?>
<li class="nav-item dropdown{{$class ?? ''}}{{ isset($active) && $active ? ' active' : '' }}">
    <a
    class="nav-link dropdown-toggle {{$titleClass ?? ''}}"
    href="#"
    id="{!! $curMenuId !!}"
    role="button"
    data-toggle="dropdown"
    aria-haspopup="true"
    aria-expanded="false"
    >
    {!! $title !!}
</a>
<div class="dropdown-menu" aria-labelledby="{!! $curMenuId !!}">
    {{ $slot ?? '' }}
</div>
</li>
