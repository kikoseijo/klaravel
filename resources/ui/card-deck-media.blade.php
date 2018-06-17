<!-- klaravel::ui.card-deck-media -->
<div class="card-columns">
    @foreach ($medias as $mediaItem)
        @php
            list($width,$height) = get_img_sizes($mediaItem->getPath('thumb'));
        @endphp
        <div class="card">
            <img class="card-img-top" src="{{$mediaItem->getUrl('thumb')}}" alt="{{$mediaItem->name}}">
            <div class="card-body">

                    <p class="card-text">
                        {{ diff_date_for_humans($mediaItem->created_at) }}
                        <span class="small text-center d-block text-muted">
                            w: {!! $width>2000 ? '<span class="text-danger font-weight-bold">'.number($width).'</span>': number($width) !!},
                            h: {!! $height>2000 ? '<span class="text-danger font-weight-bold">'.number($height).'</span>': number($height) !!}
                        </span>
                    </p>


                <p class="card-text text-center">
                    <span class="badge badge-{{($mediaItem->size / 1000) > 2000 ? 'danger' : 'warning' }}">
                        {{$mediaItem->human_readable_size}}
                    </span>
                    <span class="badge badge-info">
                        {{$mediaItem->mime_type}}
                    </span>
                </p>
            </div>
            <div class="card-footer text-center">
                <div class="btn-group btn-group-sm">
                    @isset($remove_url)
                        <a href="{{$remove_url.'/'.$mediaItem->id}}" data-toggle="tooltip" title="Delete image" class="btn btn-danger">
                            <i class="far fa-trash-alt fa-fw"></i>
                        </a>
                    @endisset
                    @isset($make_default_url)
                        <a href="{{$make_default_url.'/'.$mediaItem->id}}" data-toggle="tooltip" title="Order #1st" class="btn btn-secondary">
                            <i class="fas fa-filter fa-fw mr-1"></i> {{$mediaItem->order_column}}
                        </a>
                    @endisset
                </div>
            </div>


        </div>
    @endforeach
</div>
