@if ($records->total()>0)
  <div class="text-center text-muted py-3">
    Viewing from {!! $records->firstItem() !!} to {!! $records->lastItem() !!} of {!! $records->total() !!} record{!! $records->total() > 1 ? 's' : '' !!}
  </div>
@else
  <div class="text-center text-muted py-5">
    <h1>No records found</h1>
  </div>
@endif
