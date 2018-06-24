<!-- klaravel::crud.edit -->
@extends(config('ksoft.module.crud.layout', 'klaravel::layouts.crud'))

@section('content')
    <div class="{{$crudWrapperClass}}">
        @foreach (config('ksoft.module.crud.includes', []) as $viewToInclude)
           @includeIf($viewToInclude)
        @endforeach
        @card()
            {!! Former::open_for_files()
                ->route($model_name . '.update', $record  )
                ->populate( $record )
            !!}
            <!-- {{$viewsBasePath.$model_name.'.form'}} -->
            @includeIf($viewsBasePath.$model_name.'.form', ['submitButtonText' => 'Update'])
            {!! Former::close() !!}
        @endcard
    </div>
@endsection
