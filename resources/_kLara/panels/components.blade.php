<div class="row">
    <div class="col-sm-3 mb-5">
        <ul class="nav flex-column px-0  border-right h-100" id="klara-tabs" role="tablist">
          <li class="nav-item">
            <a class="nav-link py-2 active" id="components-tables-tab" data-toggle="tab" href="#components-tables">Tables</a>
          </li>
          <li class="nav-item border-top">
            <a class="nav-link py-2" id="components-widgets-tab" data-toggle="tab" href="#components-widgets">Widgets</a>
          </li>
          <li class="nav-item border-top">
            <a class="nav-link py-2" id="components-vue-tab" data-toggle="tab" href="#components-vue">Vue</a>
          </li>
          <li class="nav-item border-top">
            <a class="nav-link py-2" id="components-maps-tab" data-toggle="tab" href="#components-maps">Google Maps</a>
          </li>


        </ul>
    </div>
    <div class="col-sm-9">
        <div class="tab-content" id="klara-tabs">
            <div class="tab-pane fade show active" id="components-tables" role="tabpanel" aria-labelledby="components-tables-tab">
                {!! do_markdown(file_get_contents(KLARAVEL_PATH . '/wiki/components-tables.md')) !!}
            </div>
            <div class="tab-pane fade" id="components-widgets" role="tabpanel" aria-labelledby="components-widgets-tab">
                {!! do_markdown(file_get_contents(KLARAVEL_PATH . '/wiki/components-widgets.md')) !!}
            </div>
            <div class="tab-pane fade" id="components-vue" role="tabpanel" aria-labelledby="components-vue-tab">
                {!! do_markdown(file_get_contents(KLARAVEL_PATH . '/wiki/components-vue.md')) !!}
            </div>
            <div class="tab-pane fade" id="components-maps" role="tabpanel" aria-labelledby="components-maps-tab">
                {!! do_markdown(file_get_contents(KLARAVEL_PATH . '/wiki/components-maps.md')) !!}
            </div>
        </div>
    </div>
</div>
