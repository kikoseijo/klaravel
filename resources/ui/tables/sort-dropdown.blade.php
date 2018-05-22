<!-- klaravel::ui.tables.sort-dropdown -->
<div class="btn-group{{isset($size)?' btn-group-'. $size:''}}" role="group">
    <button id="btnGroupDrop1" type="button" class="btn btn-dark" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-sort fa-fw"></i>
    </button>
    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
        <a href="{{route_has($model_name.'.sort',[$item,'up'])}}" class="dropdown-item">
            <i class="fas fa-angle-up fa-fw mr-2"></i> Move up
        </a>
        <a href="{{route_has($model_name.'.sort',[$item,'down'])}}" class="dropdown-item">
            <i class="fas fa-angle-down fa-fw mr-2"></i> Move down
        </a>
        <a href="{{route_has($model_name.'.sort',[$item,'first'])}}" class="dropdown-item">
            <i class="fas fa-sort-numeric-up fa-fw mr-2"></i> Move first
        </a>
        <a href="{{route_has($model_name.'.sort',[$item,'last'])}}" class="dropdown-item">
            <i class="fas fa-sort-numeric-down fa-fw mr-2"></i> Move last
        </a>
    </div>
</div>
