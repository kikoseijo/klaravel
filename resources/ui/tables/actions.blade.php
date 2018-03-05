<td style="min-width:80px; max-width:120px;" class="text-center">
  <div class="btn-group{{isset($size)?' btn-group-'. $size:''}}" role="group">
    <a href="{{ route($model_name.'.edit', $item->id) }}" title="Edit" class="btn btn-primary">
      <i class="fal fa-edit" aria-hidden="true"></i> Edit
    </a>
    <a class="btn btn-danger"
        onclick="event.preventDefault(); if (confirm('Confirm delete?')){ document.getElementById('delete-item-{{$item->id}}').submit();}"
        href="{{ route($model_name.'.index') }}">
      <i class="fal fa-trash-alt" aria-hidden="true"></i>
    </a>
  </div>
  <form id="delete-item-{{$item->id}}" action="{{ route($model_name.'.destroy', $item->id) }}" method="POST" style="display: none;">
      @csrf
      <input type="hidden" name="_method" value="delete" />
  </form>
</td>
