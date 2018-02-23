<div class="pagination-wrapper text-center py-2 mt-2">
  {!! $records->appends(collect(config('ksoft.modules.crud.pagination_query_params'))
            ->map(function ($qParam) {
                return [$qParam => request($qParam)];
            })->toArray()
        )->render() !!}
</div>
