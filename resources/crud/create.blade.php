<!-- klaravel::crud.create -->
@extends(config('ksoft.module.crud.layout', 'klaravel::layouts.crud'))

@section('content')
    <div class="{{$crudWrapperClass}}">
        @foreach (config('ksoft.module.crud.includes', []) as $viewToInclude)
           @includeIf($viewToInclude)
        @endforeach
        @card(['title' => 'New ' . title_case($model_name)])
            {!! Former::open_for_files()->route($model_name.'.store') !!}
            <!-- {{$viewsBasePath.$model_name.'.form'}} -->
            @includeIf($viewsBasePath.$model_name.'.form')
            {!! Former::close() !!}
        @endcard
    </div>
@endsection
