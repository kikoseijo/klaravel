<!-- klaravel::ui.tables.order -->
<div class="careta">
    <div class="kflecha">
        <a href="{{route($model_name.'.index')}}?order={{$att}}&direction=asc"
        class="text-{{request('order')==$att && request('direction')=='asc' ? 'info' : 'white'}}">
        <i class="far fa-caret-up fa-fw"></i>
    </a>
    </div>
    <div class="kflecha">
        <a href="{{route($model_name.'.index')}}?order={{$att}}&direction=desc"
        class="text-{{request('order')==$att && request('direction')=='desc' ? 'info' : 'white'}}">
        <i class="far fa-caret-down fa-fw"></i>
    </a>
    </div>
</div>
