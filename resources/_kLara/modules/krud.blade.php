<h3>Generate new krud</h3>
<p class="py-2 text-muted">
    Use this form to generate new krud, only requirement its the model name. Will still read configuration
    under `config/ksoft.php` if you want that file published click here: <a href="{{route('kLara.config.publish')}}">Publish configuration file</a>
</p>

{!! Former::horizontal_open()->route('kLara.krud.gen') !!}
    {!! Former::text('model_name')->required()->label('Model name')->placeholder('ej.: User') !!}
    {!! Former::text('base_path')
        ->required()
        ->label('Base path')
        ->placeholder('ej.: User')
        ->help('Path starts at App\Http\\') !!}
    <fieldset class="form-group">
        <div class="row">
            <legend class="col-form-label col-sm-2 pt-0">Base controller</legend>
            <div class="col-sm-10">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="publish_base_krud" name="publish_base_krud" value="yes">
                    <label class="form-check-label" for="publish_base_krud">
                        You only need this to be published once or when upgrades
                    </label>
                </div>
            </div>
        </div>
    </fieldset>
    <div class="form-group row">
        <div class="col-sm-10 offset-sm-2">
            <button type="submit" class="btn btn-primary">Sign in</button>
        </div>
    </div>
{!! Former::close() !!}
