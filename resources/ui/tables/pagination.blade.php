<nav aria-label="Page navigation" class="{{ $class or '' }}">
    {!! $records->appends(collect(config('ksoft.modules.crud.pagination_query_params'))
              ->map(function ($qParam) {
                  return [$qParam => request($qParam)];
              })->toArray()
          )->links() !!}
</nav>
