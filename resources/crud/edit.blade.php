@extends('klaravel::layouts.crud')

@section('content')
    <div class="{{$crudWrapperClass}}">
        @card()
            {!! Former::open()
                ->route($model_name . '.update', $record->id  )
                ->populate( $record )
                ->open_for_files() !!}
            @includeIf($viewsBasePath.$model_name.'.form', ['submitButtonText' => 'Update'])
            {!! Former::close() !!}
        @endcard
    </div>
@endsection
