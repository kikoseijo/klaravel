<!-- klaravel::ui.tables.actions -->
<td style="{{$style or ''}}" class="align-middle text-center">
  <div class="btn-group{{isset($size)?' btn-group-'. $size:''}} klara-bt-group" role="group">
    <a href="{{ route_has($model_name.'.edit', $item->id) }}" data-toggle="tooltip" title="Edit record" class="btn btn-primary">
      <i class="far fa-edit" aria-hidden="true"></i>
    </a>
    {{$slot or ''}}

    @if (isset($item->sortable) && count($item->sortable)>0)
        @if (!isset($hide_sort))
            @include('klaravel::ui.tables.sort-dropdown')
        @endif
    @endif

    @include('klaravel::ui.tables.btn-delete')


  </div>
</td>
