<!-- klaravel::ui.tables.btn-delete -->
<a class="btn btn-danger" data-toggle="tooltip" title="Delete record"
    onclick="event.preventDefault(); if (confirm('Confirm delete?')){ document.getElementById('delete-item-{{$item->id}}').submit();}"
    href="{{ route_has($model_name.'.index') }}">
  <i class="far fa-trash-alt" aria-hidden="true"></i>
</a>
<form id="delete-item-{{$item->id}}" action="{{ route_has($model_name.'.destroy', $item->id) }}" method="POST" style="display: none;">
    @csrf
    <input type="hidden" name="_method" value="delete" />
</form>
