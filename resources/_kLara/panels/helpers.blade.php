<div class="row">
    <div class="col-sm-3 mb-5">
        <ul class="nav flex-column px-0  border-right h-100" id="klara-tabs" role="tablist">
          <li class="nav-item">
            <a class="nav-link py-2 active" id="helpers-commons-tab" data-toggle="tab" href="#helpers-commons">kLaravel integration</a>
          </li>
          <li class="nav-item border-top">
            <a class="nav-link py-2" id="helpers-seeds-tab" data-toggle="tab" href="#helpers-seeds">Seeding</a>
          </li>
          <li class="nav-item border-top">
            <a class="nav-link py-2" id="helpers-passport-tab" data-toggle="tab" href="#helpers-passport">Passport (Laravel)</a>
          </li>
          <li class="nav-item border-top">
            <a class="nav-link py-2" id="helpers-backups-tab" data-toggle="tab" href="#helpers-backups">Backup</a>
          </li>
          {{-- <li class="nav-item border-top">
            <a class="nav-link py-2" id="helpers-seo-tab" data-toggle="tab" href="#helpers-seo">SEO</a>
          </li> --}}
          <li class="nav-item border-top">
            <a class="nav-link py-2" id="helpers-validations-tab" data-toggle="tab" href="#helpers-validations">Validation rules</a>
          </li>
          <li class="nav-item border-top">
            <a class="nav-link py-2" id="helpers-config-tab" data-toggle="tab" href="#helpers-config">Settings (db)</a>
          </li>
          <li class="nav-item border-top">
            <a class="nav-link py-2" id="helpers-mailables-tab" data-toggle="tab" href="#helpers-mailables">Mailables</a>
          </li>
          <li class="nav-item border-top">
            <a class="nav-link py-2" id="helpers-translate-tab" data-toggle="tab" href="#helpers-translate">Translate</a>
          </li>
          <li class="nav-item border-top">
            <a class="nav-link py-2" id="helpers-translatable-tab" data-toggle="tab" href="#helpers-translatable">Translatable</a>
          </li>
          <li class="nav-item border-top">
            <a class="nav-link py-2" id="helpers-sortable-tab" data-toggle="tab" href="#helpers-sortable">Sortable</a>
          </li>
          <li class="nav-item border-top">
            <a class="nav-link py-2" id="helpers-tagable-tab" data-toggle="tab" href="#helpers-tagable">Tagable</a>
          </li>
          <li class="nav-item border-top">
            <a class="nav-link py-2" id="helpers-functions-tab" data-toggle="tab" href="#helpers-functions">Helper functions</a>
          </li>


        </ul>
    </div>
    <div class="col-sm-9">
        <div class="tab-content" id="klara-tabs">
            <div class="tab-pane fade show active" id="helpers-commons" role="tabpanel" aria-labelledby="helpers-commons-tab">
                {!! do_markdown(file_get_contents(KLARAVEL_PATH . '/wiki/helpers-commons.md')) !!}
            </div>
            <div class="tab-pane fade" id="helpers-seeds" role="tabpanel" aria-labelledby="helpers-seeds-tab">
                {!! do_markdown(file_get_contents(KLARAVEL_PATH . '/wiki/helpers-seeds.md')) !!}
            </div>
            <div class="tab-pane fade" id="helpers-seo" role="tabpanel" aria-labelledby="helpers-seo-tab">
                {!! do_markdown(file_get_contents(KLARAVEL_PATH . '/wiki/helpers-seo.md')) !!}
            </div>
            <div class="tab-pane fade" id="helpers-validations" role="tabpanel" aria-labelledby="helpers-validations-tab">
                {!! do_markdown(file_get_contents(KLARAVEL_PATH . '/wiki/helpers-validations.md')) !!}
            </div>
            <div class="tab-pane fade" id="helpers-passport" role="tabpanel" aria-labelledby="helpers-passport-tab">
                {!! do_markdown(file_get_contents(KLARAVEL_PATH . '/wiki/helpers-passport.md')) !!}
            </div>
            <div class="tab-pane fade" id="helpers-backups" role="tabpanel" aria-labelledby="helpers-backups-tab">
                {!! do_markdown(file_get_contents(KLARAVEL_PATH . '/wiki/helpers-backups.md')) !!}
            </div>
            <div class="tab-pane fade" id="helpers-config" role="tabpanel" aria-labelledby="helpers-config-tab">
                {!! do_markdown(file_get_contents(KLARAVEL_PATH . '/wiki/helpers-config.md')) !!}
            </div>
            <div class="tab-pane fade" id="helpers-mailables" role="tabpanel" aria-labelledby="helpers-mailables-tab">
                {!! do_markdown(file_get_contents(KLARAVEL_PATH . '/wiki/helpers-mailables.md')) !!}
            </div>
            <div class="tab-pane fade" id="helpers-translate" role="tabpanel" aria-labelledby="helpers-translate-tab">
                {!! do_markdown(file_get_contents(KLARAVEL_PATH . '/wiki/helpers-translate.md')) !!}
            </div>
            <div class="tab-pane fade" id="helpers-translatable" role="tabpanel" aria-labelledby="helpers-translatable-tab">
                {!! do_markdown(file_get_contents(KLARAVEL_PATH . '/wiki/helpers-translatable.md')) !!}
            </div>
            <div class="tab-pane fade" id="helpers-sortable" role="tabpanel" aria-labelledby="helpers-sortable-tab">
                {!! do_markdown(file_get_contents(KLARAVEL_PATH . '/wiki/helpers-sortable.md')) !!}
            </div>
            <div class="tab-pane fade" id="helpers-tagable" role="tabpanel" aria-labelledby="helpers-tagable-tab">
                {!! do_markdown(file_get_contents(KLARAVEL_PATH . '/wiki/helpers-tags.md')) !!}
            </div>
            <div class="tab-pane fade" id="helpers-functions" role="tabpanel" aria-labelledby="helpers-functions-tab">
                {!! do_markdown(file_get_contents(KLARAVEL_PATH . '/wiki/helpers-functions.md')) !!}
            </div>
        </div>
    </div>
</div>
