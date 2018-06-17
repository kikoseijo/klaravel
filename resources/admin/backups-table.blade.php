@if (count($backups))
    <table class="{{config('ksoft.style.table_style')}}">
        <thead class="thead-dark">
            <tr>
                <th>Date</th>
                <th>File</th>
                <th class="text-center">Size</th>
                <th style="width:230px;"></th>
            </tr>
        </thead>
        <tbody>
            @foreach($backups as $backup)
                <tr>
                    <td>
                        {{ date('d M Y, g:ia', strtotime($backup['last_modified'])) }}
                        <span class="text-muted small">({{ diff_string_for_humans($backup['last_modified']) }})</span>
                    </td>
                    <td>{{ $backup['file_name'] }}</td>
                    <td class="text-right">{{ $backup['file_size'] }}</td>

                    <td class="text-center">
                        <div class="btn-group btn-group-sm" role="group" aria-label="name-id">
                            <a class="btn btn-primary" href="{{ url( $routeName . '/download/'.$backup['file_name']) }}">
                                <i class="far fa-cloud-download-alt fa-fw"></i>
                            </a>
                            <a class="btn btn-danger" data-button-type="delete" href="{{ url($routeName . '/delete/'.$backup['file_name']) }}">
                                <i class="far fa-trash-alt fa-fw"></i>

                            </a>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    @includeif('klaravel::_parts.no-records', ['recrods_name' => 'backups'])
@endif
