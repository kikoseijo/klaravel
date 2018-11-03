<h3>Generate new Scaffold</h3>
<p class="py-2 text-muted">
    Use this form to generate new krud, only requirement its the model name. Configure the output
    trought configuration file `config/ksoft.php`.
</p>

{!! Former::horizontal_open()->route('kLara.krud.gen') !!}
    {!! Former::text('model_name')->required()->label('Model name')->placeholder('ej.: User') !!}
    {!! Former::text('base_path')
        ->label('Base path')
        ->placeholder('ej.: Backend')
        ->help('Path starts at App\Http\\') !!}

    <div class="form-group row mt-3">
        <div class="col-sm-10 offset-sm-2">
            <button type="submit" class="btn btn-primary">Create new Scaffold</button>
        </div>
    </div>
{!! Former::close() !!}


<hr class="my-5">

<h3>Publish files</h3>


<p class="py-3">
    You should only publish this files once ?? to update from an older version,
    you will loose any changes made to them if you overwrite them.
</p>

<a href="{{route('kLara.publish')}}?file=config"
    onclick="javascript:return confirm('Are you sure?, Will overwrite existing configuration.')"
    class="btn btn-secondary p-3 mr-3">
    Configuration
</a>

<a href="{{route('kLara.publish')}}?file=base_ctrl"
onclick="javascript:return confirm('Are you sure?, Will overwrite existing configuration.')"
class="btn btn-secondary p-3">
BaseCtrl (v3)
</a>

<a href="{{route('kLara.publish')}}?file=base_controller"
    onclick="javascript:return confirm('Are you sure?, Will overwrite existing configuration.')"
    class="btn btn-secondary p-3">
    BaseKrudController
</a>


<div class="w-100 my-5">&nbsp;</div>
