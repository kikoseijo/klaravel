<!-- klaravel::ui.tables.actions -->
<td style="{{$style ?? ''}}" class="align-middle text-right">
  <div class="btn-group{{isset($size)?' btn-group-'. $size:''}} klara-bt-group" role="group">

    {{-- @php
        $editBtnLink = !isset($hide_edit) || (isset($hide_edit) && !$hide_edit)
                ? route_has($model_name.'.edit', $item->id)
                : '#disabled" disabled="disabled';
    @endphp
    <a href="{!! $editBtnLink  !!}" data-toggle="tooltip" title="Edit record" class="btn btn-primary">
        <i class="far fa-edit" aria-hidden="true"></i>
    </a> --}}
    @if (!isset($hide_edit) || (isset($hide_edit) && !$hide_edit))
        <a href="{{route_has($model_name.'.edit', $item->id)}}" data-toggle="tooltip" title="Edit record" class="btn btn-primary">
            <i class="fas fa-fw fa-pencil-alt" aria-hidden="true"></i>
        </a>
    @endif

    {{$slot ?? ''}}

    @if (isset($item->sortable) && count($item->sortable)>0)
        @if (!isset($hide_sort))
            @include('klaravel::ui.tables.sort-dropdown')
        @endif
    @endif

    @if (!isset($hide_delete) || (isset($hide_delete) && !$hide_delete))
        @include('klaravel::ui.tables.btn-delete')
    @endif


  </div>
</td>
