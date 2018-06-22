@extends('%base_layout%')

@section('content')
    <div class="{{$crudWrapperClass}}">
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
