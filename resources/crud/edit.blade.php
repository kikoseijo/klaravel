<!-- klaravel::crud.edit -->
@extends('klaravel::layouts.crud')

@section('content')
    <div class="{{$crudWrapperClass}}">
        @card()
            {!! Former::open_for_files()
                ->route($model_name . '.update', $record->id  )
                ->populate( $record )
            !!}
            <!-- {{$viewsBasePath.$model_name.'.form'}} -->
            @includeIf($viewsBasePath.$model_name.'.form', ['submitButtonText' => 'Update'])
            {!! Former::close() !!}
        @endcard
    </div>
@endsection
