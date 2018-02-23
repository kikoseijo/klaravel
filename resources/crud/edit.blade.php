@extends('klaravel::layouts.crud')

@section('content')
    <div class="{{config('klaravel.style.crud_container_wrapper','container -body-block pb-5')}}">
        @card()
            {!! Former::open()
                ->route($model_name . '.update', $record->id  )
                ->populate( $record )
                ->open_for_files() !!}
            @includeIf(config('klaravel.modules.crud.views_base_path').'.'.$model_name.'.form', ['submitButtonText' => 'Update'])
            {!! Former::close() !!}
        @endcard
    </div>
@endsection
