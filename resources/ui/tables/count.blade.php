@if ($records->total()>0)
  <div class="text-muted {{$class or 'text-center'}}">
    Viewing from {!! $records->firstItem() !!} to {!! $records->lastItem() !!} of {!! $records->total() !!} record{!! $records->total() > 1 ? 's' : '' !!}
  </div>
@else
  <div class="text-muted {{$class or 'text-center'}}">
    <h1>No records found</h1>
  </div>
@endif
