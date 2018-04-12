# Controller traits

##### CanChangeStatuses

On your controller

```
use Ksoft\Klaravel\Traits\CanChangeStatuses;
// You must specify the field/s name and its changeable options
protected $changeableStatus = [
  'active' => 'bool', // for booleans you can send true, on, 1
  'status' => ['A','B','C'] // for enums, must exist in array.
];
```

On your routes

```
Route::get('MODEL/change-status/{id}/{key}/{status}/', 'YOUR__Controller@changeStatus')->name('MODEL.status_change');
```

On your blades, for example, a table column clickable icon:

```
<td>
  <a href="{{route($model_name.'.status_change',[$item->id,'active', $item->active ? '0' : '1'])}}">
      <i class="fas fa-circle text-{{ $item->active ? 'success' : 'danger' }}"></i>
  </a>
</td>
```

##### CanUploadMedia

This trait works with the Vue Component `klaravel-media-upload` and [laravel-media-library](https://docs.spatie.be/laravel-medialibrary/v7)

```
// Install library
composer require spatie/laravel-medialibrary:^7.0.0
// Publish migrations
php artisan vendor:publish --provider="Spatie\MediaLibrary\MediaLibraryServiceProvider" --tag="migrations"
// Migrate
php artisan migrate
// Optional, publish configuration
php artisan vendor:publish --provider="Spatie\MediaLibrary\MediaLibraryServiceProvider" --tag="config"
```

Add Trait to controller

```
use Ksoft\Klaravel\Traits\CanUploadMedia;
```

Add the routes

```
Route::post('MODEL_PATH/{id}/media-upload', 'MODELController@upload')->name('MODEL_PATH.media.upload');
Route::get('MODEL_PATH/{id}/remove-media/{media?}', 'MODELController@remove')->name('MODEL_PATH.media.remove');
Route::get('MODEL_PATH/{id}/make-default-media/{media?}', 'MODELController@mediaDefault')->name('MODEL_PATH.media.makedefault');
```

On your blade, using components.

```
<div class="row">
    <div class="col-sm-4">
        <klaravel-element-upload
            :fotos="[]"
            help="Recommended image size 1100x400 pixels"
            :is-multiple="true"
            base-url="{{route($model_name.'.media.upload', $record->id)}}"
            record-id="{{$record->id}}">
        </klaravel-element-upload>
    </div>
    <div class="col-sm-8">
        @include('klaravel::ui.card-deck-media', [
            'remove_url' => route($model_name.'.media.remove', $record->id),
            'make_default_url' => route($model_name.'.media.makedefault', $record->id)
        ])
    </div>
</div>
```
