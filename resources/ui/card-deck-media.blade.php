<!-- klaravel::ui.card-deck-media -->
<div class="card-columns">
    @foreach ($medias as $mediaItem)
        <div class="card">
            <img class="card-img-top" src="{{$mediaItem->getUrl()}}" alt="{{$mediaItem->name}}">
            <div class="card-body">
                <strong>{{$mediaItem->name}}</strong>
                <p class="card-text text-center">
                    <span class="badge badge-{{($mediaItem->size / 1000) > 2000 ? 'danger' : 'warning' }}">
                        {{$mediaItem->human_readable_size}}
                    </span>
                    <span class="badge badge-info">
                        {{$mediaItem->mime_type}}
                    </span>
                </p>
            </div>
            <div class="card-footer">
                @isset($remove_url)
                    <a href="{{$remove_url.'/'.$mediaItem->id}}" style="color:tomato;" class="text-right">
                        <i class="far fa-trash-alt"></i>
                    </a>
                @endisset
                <small class="text-muted">
                    {{ diff_date_for_humans($mediaItem->created_at) }}
                </small>
            </div>
        </div>
    @endforeach
</div>
