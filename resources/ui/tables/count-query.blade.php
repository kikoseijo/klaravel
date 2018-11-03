<!-- klaravel::ui.tables.count-query -->
@php
    $totalRecordCount = count($records);
@endphp
@if ($totalRecordCount>0)
    <div class="{{$class ?? ''}}">
        {!!$totalRecordCount !!} record{!! $totalRecordCount > 1 ? 's' : '' !!} total
    </div>
@else
    <div class="{{$class ?? 'text-center'}}">
        <h1>No records found</h1>
    </div>
@endif
