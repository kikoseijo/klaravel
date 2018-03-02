<table class="{{config('ksoft.style.table_style')}}">
    <thead class="thead-dark">
        <tr>
            <th>#</th>
            <th>Status</th>
            <th>Name</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    @foreach($records as $item)
        <tr>
            <th scope="row">{{ $item->id }}</th>
            <td><i class="fas fa-circle text-{{ $item->active ? 'success' : 'danger' }}"></i></td>
            <td><a href="{{route('%model_name_url%.edit', $item->id)}}">{{ $item->name }}</a></td>
            @include('klaravel::ui.tables.actions')
        </tr>
    @endforeach
    </tbody>
</table>
