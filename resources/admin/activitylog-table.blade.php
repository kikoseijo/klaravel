@isset($iLogs)
    @if(count($iLogs))
        <table class="{{config('ksoft.style.table_style')}}">
          <thead class="{{config('ksoft.style.thead')}}">
            <tr>
              <th>Date</th>
              <th>Activity</th>
              <th>User</th>
            </tr>
          </thead>
          <tbody>
            @foreach($iLogs as $logItem)
              <tr>
                {{-- <td>{{ diff_date_for_humans($logItem->created_at) }}</td> --}}
                <td>{{ $logItem->created_at->diffForHumans() }}</td>
                <td>{!! $logItem->description !!}</td>
                <td>
                  @if($logItem->causer)
                      {{ $logItem->causer->name }}
                  @endif
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
    @else
        <div class="text-center py-5">
            <h4 class="text-muted">No records found.</h4>
        </div>
    @endif
@endisset
