<div class="row">
    <div class="col-sm-3 mb-5">
        <ul class="nav flex-column px-0  border-right h-100" id="klara-tabs" role="tablist">
          <li class="nav-item">
            <a class="nav-link py-2 active" id="trait-controllers-tab" data-toggle="tab" href="#trait-controllers">For Controllers</a>
          </li>
          <li class="nav-item border-top">
            <a class="nav-link py-2" id="trait-models-tab" data-toggle="tab" href="#trait-models">Models</a>
          </li>
          <li class="nav-item border-top">
            <a class="nav-link py-2" id="trait-eloquent-tab" data-toggle="tab" href="#trait-eloquent">EloquentRepository</a>
          </li>
          <li class="nav-item border-top">
            <a class="nav-link py-2" id="trait-repositories-tab" data-toggle="tab" href="#trait-repositories">QueryFiltersTrait</a>
          </li>
          <li class="nav-item border-top">
            <a class="nav-link py-2" id="trait-responses-tab" data-toggle="tab" href="#trait-responses">Responses</a>
          </li>


        </ul>
    </div>
    <div class="col-sm-9">
        <div class="tab-content" id="klara-tabs">
            <div class="tab-pane fade show active" id="trait-controllers" role="tabpanel" aria-labelledby="trait-controllers-tab">
                {!! do_markdown(file_get_contents(KLARAVEL_PATH . '/wiki/trait-controllers.md')) !!}
            </div>
            <div class="tab-pane fade" id="trait-models" role="tabpanel" aria-labelledby="trait-models-tab">
                {!! do_markdown(file_get_contents(KLARAVEL_PATH . '/wiki/trait-models.md')) !!}
            </div>
            <div class="tab-pane fade" id="trait-repositories" role="tabpanel" aria-labelledby="trait-repositories-tab">
                @component('klaravel::ui.tab', [
                  'tabs' => [
                    'repo-help' => '<i class="far fa-info  fa-fw mr-1"></i> Usage information',
                    'repo-trait' => '<span class="text-warning"><i class="far  fa-fw fa-code mr-1"></i> Source code</span>'
                  ]
                ])
                    <div id="repo-help" class="tab-pane fade active show" role="tabpanel" aria-labelledby="repo-help-tab">
                        {!! do_markdown(file_get_contents(KLARAVEL_PATH . '/wiki/trait-repositories.md')) !!}
                    </div>
                    <div class="tab-pane fade" id="repo-trait" role="tabpanel" aria-labelledby="repo-trait-tab">
                        {!! do_markdown('```' .file_get_contents(KLARAVEL_PATH . '/src/Traits/Repositories/QueryFiltersTrait.php').'```') !!}
                    </div>
                @endcomponent
            </div>
            <div class="tab-pane fade" id="trait-responses" role="tabpanel" aria-labelledby="trait-responses-tab">
                {!! do_markdown(file_get_contents(KLARAVEL_PATH . '/wiki/trait-responses.md')) !!}
            </div>
            <div class="tab-pane fade" id="trait-eloquent" role="tabpanel" aria-labelledby="trait-eloquent-tab">
                @component('klaravel::ui.tab', [
                  'tabs' => [
                    'elo-help' => '<i class="far  fa-fw fa-info mr-1"></i> Usage information',
                    'elo-trait' => '<span class="text-warning"><i class="far  fa-fw fa-code mr-1"></i> Source code</span>'
                  ]
                ])
                    <div id="elo-help" class="tab-pane fade active show" role="tabpanel" aria-labelledby="elo-help-tab">
                        {!! do_markdown(file_get_contents(KLARAVEL_PATH . '/wiki/trait-eloquent.md')) !!}
                    </div>
                    <div class="tab-pane fade" id="elo-trait" role="tabpanel" aria-labelledby="elo-trait-tab">
                        {!! do_markdown('```' .file_get_contents(KLARAVEL_PATH . '/src/Repositories/EloquentRepo.php').'```') !!}
                    </div>
                @endcomponent
            </div>
        </div>
    </div>
</div>
