@if (count($backups))
    <table class="{{config('ksoft.style.table_style')}}">
        <thead class="thead-dark">
            <tr>
                <th>File</th>
                <th>Size</th>
                <th>Date</th>
                <th>Age</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($backups as $backup)
                <tr>
                    <td>{{ $backup['file_name'] }}</td>
                    <td>{{ $backup['file_size'] }}</td>
                    <td>
                        {{ date('d/M/Y, g:ia', strtotime($backup['last_modified'])) }}
                    </td>
                    <td>
                        {{ $backup['last_modified'] }}
                    </td>
                    <td class="text-right">
                        <div class="btn-group btn-group-sm" role="group" aria-label="name-id">
                            <a class="btn btn-primary" href="{{ url( $routeName . '/download/'.$backup['file_name']) }}">
                                <i class="far fa-cloud-download"></i> Download
                            </a>
                            <a class="btn btn-danger" data-button-type="delete" href="{{ url($routeName . '/delete/'.$backup['file_name']) }}">
                                <i class="far fa-trash"></i>
                                Delete
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
