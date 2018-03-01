@if (count($backups))
    <table class="table table-striped table-bordered">
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
                        <a class="btn btn-primary" href="{{ url( $routeName . '/download/'.$backup['file_name']) }}">
                            <i class="fas fa-cloud-download"></i> Download</a>
                        <a class="btn btn-xs btn-danger" data-button-type="delete" href="{{ url($routeName . '/delete/'.$backup['file_name']) }}">
                            <i class="fal fa-trash"></i>
                            Delete
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <div class="text-center py-5">
        <h1 class="text-muted">No backups found</h1>
    </div>
@endif
