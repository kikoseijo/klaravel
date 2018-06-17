<!-- klaravel::ui.tables.btn-delete -->
@php
    $deleteBtnEnabled = !isset($hide_delete) || (isset($hide_delete) && $hide_delete == false);
    $deleteBtnLink = $deleteBtnEnabled ? route_has($model_name.'.index') : '#disabled';
    $confirmMsg = "event.preventDefault(); if (confirm('Confirm delete?')){ document.getElementById('delete-item-{$item->id}').submit();}";
@endphp
<a class="btn btn-danger" {!!$deleteBtnEnabled?'data-toggle="tooltip" title="Delete record"':''!!}
    onclick="{!! $deleteBtnEnabled ? $confirmMsg : '' !!}"  href="{{ $deleteBtnLink }}">
  <i class="fas fa-trash-alt fa-fw" aria-hidden="true"></i>
</a>

@if ($deleteBtnEnabled)
    <form id="delete-item-{{$item->id}}" action="{{ route_has($model_name.'.destroy', $item->id) }}" method="POST" style="display: none;">
        @csrf
        <input type="hidden" name="_method" value="delete" />
    </form>
@endif
