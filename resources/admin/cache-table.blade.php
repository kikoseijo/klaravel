@isset($records)
  @if(count($records))
      <table class="{{config('ksoft.style.table_style')}}">
        <thead class="{{config('ksoft.style.thead')}}">
        <tr>
          <th></th>
          <th>Expire</th>
          <th>Key</th>
          <th>Value</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @foreach($records as $record)
            {{-- @php
                $payload = unserialize(base64_decode($session->payload));
                $ante = array_get($payload,'_previous');
            @endphp --}}
          <tr>
              <td>
                  <a href="#ghogo" onclick="$('#table-row-{{$loop->index}}').toggle();">
                      <i class="far fa-chevron-right"></i>
                  </a>
              </td>
            <td>{{ date('d M H:i', $record->expiration) }}</td>

            <td>{{ $record->key }}</td>
            <td>{{ $record->value }}</td>

            <td style="width:60px;" class="text-center">
                <a href="{{ route('kCache.delete', $record->key) }}" class="btn btn-danger btn-sm">
                  <i class="far fa-trash"></i>
                </a>
            </td>
          </tr>
          <tr id="table-row-{{$loop->index}}" style="display:none">
            <td class="text-muted" colspan="4">
                <code>{!! $record->value !!}</code>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
    {{-- <a href="{{ action('Back\ActivitylogController@index') }}">
      Ver todos los logs de actividad
    </a> --}}
    @else
        @includeif('klaravel::_parts.no-records')

    @endif
@endisset
