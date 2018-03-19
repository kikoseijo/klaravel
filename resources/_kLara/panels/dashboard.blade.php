<div class="row">
    <div class="col-sm-3 mb-5">
        <ul class="nav flex-column px-0  border-right h-100" id="klara-tabs" role="tablist">
          <li class="nav-item">
            <a class="nav-link py-2 active" id="krud-tab" data-toggle="tab" href="#krud">Krud</a>
          </li>
          <li class="nav-item border-top">
            <a class="nav-link py-2" id="krud-layout-tab" data-toggle="tab" href="#krud-layout">Krud layout</a>
          </li>
          <li class="nav-item border-top">
            <a class="nav-link py-2" id="settings-tab" data-toggle="tab" href="#settings">Settings</a>
          </li>
          <li class="nav-item border-top">
            <a class="nav-link py-2" id="former-tab" data-toggle="tab" href="#former">Formers</a>
          </li>
          <li class="nav-item border-top">
            <a class="nav-link py-2" id="utils-tab" data-toggle="tab" href="#utils">Miscellaneous</a>
          </li>

        </ul>
    </div>
    <div class="col-sm-9">
        <div class="tab-content" id="klara-tabs">
            <div class="tab-pane fade show active" id="krud" role="tabpanel" aria-labelledby="krud-tab">
                @include('klaravel::_kLara.modules.krud')
                {!! do_markdown(file_get_contents(KLARAVEL_PATH . '/wiki/krud.md')) !!}
            </div>
            <div class="tab-pane fade" id="krud-layout" role="tabpanel" aria-labelledby="krud-layout-tab">
                <h3>Krud base layout</h3><br />
                {!! do_markdown('```' .file_get_contents(KLARAVEL_PATH . '/resources/layouts/crud.blade.php').'```') !!}
            </div>
            <div class="tab-pane fade" id="former" role="tabpanel" aria-labelledby="former-tab">
                {!! do_markdown(file_get_contents(KLARAVEL_PATH . '/wiki/formers.md')) !!}
            </div>
            <div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="settings-tab">Settings</div>
            <div class="tab-pane fade" id="utils" role="tabpanel" aria-labelledby="utils-tab">
                @include('klaravel::_kLara.panels.utils')

            </div>
        </div>
    </div>
</div>
