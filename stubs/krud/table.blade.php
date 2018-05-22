<table class="{{config('ksoft.style.table_style')}}">
    <caption class="text-right">@includeIf('klaravel::ui.tables.count')</caption>
    <thead class="thead-dark">
        <tr>
            <th>#</th>
            <th class="btn-actions"></th>
            <th class="text-center">Name</th>
            <th><i class="fas fa-calendar"></i></th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    @foreach($records as $item)
        <tr>
            <th scope="row">{{ $item->id }}</th>
            <td class="text-center align-middle">
                <a href="{{route_has($model_name.'.status_change',[$item->id,'active', $item->active ? '0' : '1'])}}">
                    <i class="{{ $item->active ? 'far fa-eye text-success' : 'far fa-eye-slash text-danger' }}"></i>
                </a>
            </td>
            <td><a href="{{route($model_name.'.edit', $item->id)}}">{{ $item->name }}</a></td>
            <td class="align-middle text-right">{{$item->created_at->diffForHumans()}}</td>
            @include('klaravel::ui.tables.actions', ['size' => 'sm'])
        </tr>
    @endforeach
    </tbody>
</table>
