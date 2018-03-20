<nav aria-label="Page navigation" class="{{ $class or '' }}">
    <?php $arrBase = config('ksoft.module.crud.pagination_query_params'); ?>
    {!! $records
        ->appends(array_combine($arrBase, array_map('request', $arrBase)))
        ->links()
    !!}
</nav>
