<!-- klaravel::ui.tables.media_info -->
@if (isset($item))
    <span class="text-muted">{{$item->name}}</span><br />
    <div class="badge badge-{{$item->size>600000?$item->size>1000000?'danger':'warning':'success'}} mr-3">
        {{$item->human_readable_size}}
    </div>
    <div class="badge badge-info">{{$item->mime_type}}</div>
@else
    no <code>$item</code> defined
@endif
