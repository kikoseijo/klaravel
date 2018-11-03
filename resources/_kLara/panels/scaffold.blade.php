<div class="row">
    <div class="col-sm-3 mb-5">
        <ul class="nav flex-column px-0  border-right h-100" id="klara-tabs" role="tablist">
          <li class="nav-item">
            <a class="nav-link py-2 active" id="krud-tab" data-toggle="tab" href="#krud">Krud generator</a>
          </li>
          <li class="nav-item border-top">
              <a class="nav-link py-2" id="krud-help-tab" data-toggle="tab" href="#krud-help">Krud user guide</a>
          </li>
          <li class="nav-item border-top">
              <a class="nav-link py-2" id="krud-repo-tab" data-toggle="tab" href="#krud-repo">Repository <small>(Eloquent)</small></a>
          </li>
          <li class="nav-item border-top">
              <a class="nav-link py-2" id="krud-repo-filters-tab" data-toggle="tab" href="#krud-repo-filters">Repository <small>(Query filters)</small></a>
          </li>
          <li class="nav-item border-top">
              <a class="nav-link py-2" id="krud-policy-tab" data-toggle="tab" href="#krud-policy">Policy resource</a>
          </li>
          <li class="nav-item border-top">
              <a class="nav-link py-2" id="krud-views-tab" data-toggle="tab" href="#krud-views">Krud Reusable views</a>
          </li>
          <li class="nav-item border-top">
            <a class="nav-link py-2" id="krud-layout-tab" data-toggle="tab" href="#krud-layout">Krud layout <small>(reference)</small></a>
          </li>
          <li class="nav-item border-top border-bottom">
            <a class="nav-link py-2" id="former-tab" data-toggle="tab" href="#former">Formers quick refrence</a>
          </li>
        </ul>
    </div>
    <div class="col-sm-9">
        <div class="tab-content" id="klara-tabs">
            <div class="tab-pane fade show active" id="krud" role="tabpanel" aria-labelledby="krud-tab">
                @include('klaravel::_kLara.modules.krud')
            </div>
            <div class="tab-pane fade" id="krud-help" role="tabpanel" aria-labelledby="krud-help-tab">
                {!! do_markdown(file_get_contents(KLARAVEL_PATH . '/wiki/krud-help.md')) !!}
            </div>
            <div class="tab-pane fade" id="krud-policy" role="tabpanel" aria-labelledby="krud-policy-tab">
                {!! do_markdown(file_get_contents(KLARAVEL_PATH . '/wiki/krud-policy.md')) !!}
            </div>
            <div class="tab-pane fade" id="krud-views" role="tabpanel" aria-labelledby="krud-views-tab">
                {!! do_markdown(file_get_contents(KLARAVEL_PATH . '/wiki/krud-views.md')) !!}
            </div>
            <div class="tab-pane fade" id="krud-repo" role="tabpanel" aria-labelledby="krud-repo-tab">
                <h1>Eloquent Repository</h1>
                <p class="mt-3">This class powers up your Repository, as it where your class extends from.</p>
                <p>Use it as a reference to avoid writing repeated code.</p>
                {!! do_markdown('```' .file_get_contents(KLARAVEL_PATH . '/src/Contracts/EloquentRepoContract.php').'```') !!}
            </div>
            <div class="tab-pane fade" id="krud-repo-filters" role="tabpanel" aria-labelledby="krud-repo-filters-tab">
                <h1>Query Filters Trait</h1>
                <p class="mt-3">
                    Powers up EloquentRepository for complex queries.
                </p>
                <pre><code>use Ksoft\Klaravel\Traits\QueryFiltersTrait;</code></pre>
                <p>More information and example use in <a href="{{route('kLara.wiki','traits')}}">wiki-traits</a></p>
                {!! do_markdown('```' .file_get_contents(KLARAVEL_PATH . '/src/Traits/Repositories/QueryFiltersTrait.php').'```') !!}
            </div>
            <div class="tab-pane fade" id="krud-layout" role="tabpanel" aria-labelledby="krud-layout-tab">
                <h1>Krud base layout</h1>
                <p class="mt-3">Extend your blade views ?? copy paste to your project folder</p>
                <pre class="mb-0 pb-0">
                    <code>&#64;extends(config('ksoft.module.crud.layout', 'klaravel::layouts.crud'))</code>
                </pre>
                <p>
                    Pay attention on available <strong>&#64;stack</strong>
                    you can use to push code on diferent parts like <strong>stylesheets, js, modals & scripts</strong>.
                </p>
                {!! do_markdown('```' .file_get_contents(KLARAVEL_PATH . '/resources/layouts/crud.blade.php').'```') !!}
            </div>
            <div class="tab-pane fade" id="former" role="tabpanel" aria-labelledby="former-tab">
                <h1>Formers quick reference</h1>
                @if (config('former.framework') != 'Ksoft\Klaravel\Utils\FormerBootstrap4')
                    <a href="{{route('kLara.publish')}}?file=formers" class="btn my-3 btn-primary">Publish configuration file</a>
                @endif
                {!! do_markdown(file_get_contents(KLARAVEL_PATH . '/wiki/formers.md')) !!}
            </div>
        </div>
    </div>
</div>
