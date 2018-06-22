@extends('%base_layout%')

@section('content')
    <div class="{{$crudWrapperClass}}">
        @card(['title' => 'New ' . title_case($model_name)])
            {!! Former::open_for_files()->route($model_name.'.store') !!}
            <!-- {{$viewsBasePath.$model_name.'.form'}} -->
            @includeIf($viewsBasePath.$model_name.'.form')
            {!! Former::close() !!}
        @endcard
    </div>
@endsection
