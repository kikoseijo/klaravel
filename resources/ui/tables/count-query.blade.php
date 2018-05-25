<!-- klaravel::ui.tables.count-query -->
@php
    $totalRecordCount = count($records);
@endphp
@if ($totalRecordCount>0)
    <div class="{{$class or ''}}">
        {!!$totalRecordCount !!} record{!! $totalRecordCount > 1 ? 's' : '' !!}
    </div>
@else
    <div class="{{$class or 'text-center'}}">
        <h1>No records found</h1>
    </div>
@endif
