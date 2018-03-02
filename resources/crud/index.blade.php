@extends('klaravel::layouts.crud')

@section('content')
    <div class="{{$crudWrapperClass}}">
        @card(['title' => 'Listing ' . title_case(str_plural($model_name))])
            @includeIf('klaravel::ui.tables.actions-menu')
            @if ($records->total()>0)
              @includeIf('klaravel::ui.tables.pagination',['class'=> 'py-2 mt-2'])
              @includeIf($viewsBasePath.$model_name.'.table')
              @includeIf('klaravel::ui.tables.count')
          @else
              <div class="text-center py-5">
                  <h3 class="text-muted">No records found</h3>
              </div>
            @endif
        @endcard
    </div>
@endsection
