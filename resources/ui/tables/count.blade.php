<!-- klaravel::ui.tables.count -->

@if ($records->total()>0)
    <div class="{{$class or ''}}">
        Showing records from {!! $records->firstItem() !!} to {!! $records->lastItem() !!} of {!! $records->total() !!} record{!! $records->total() > 1 ? 's' : '' !!}
    </div>
@else
    <div class="{{$class or 'text-center'}}">
        <h1>No records found</h1>
    </div>
@endif
