<?php namespace Ksoft\Klaravel\Traits;

use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;

/**
 * Trait CanUploadMedia.
 * ----------------
 * Routes
 * ----------------
 * Route::post('MODEL_PATH/{id}/media-upload', 'MODELController@upload')->name('MODEL_PATH.media.upload');
 * Route::get('MODEL_PATH/{id}/remove-media/{media?}', 'MODELController@remove')->name('MODEL_PATH.media.remove');
 * ----------------
 * VUE
 * ----------------
 * <file-upload-component
 *    :fotos="[]"
 *        :is-multiple="true"
 *        base-url="{{route_has($model_name.'.media.upload', $record->id)}}"
 *        record-id="{{$record->id}}">
 *    </file-upload-component>
 * props: ['fotos', 'recordId', 'baseUrl', 'isMultiple'],
 */
trait CanUploadMedia
{
    public function upload(Request $request, $id)
    {
        $record = $this->repo->find($id);
        $record->addMediaFromRequest('foto')->toMediaCollection('images');

        return $record->getMedia();
    }

    public function remove($id, Media $media)
    {
        $record = $this->repo->find($id);
        $record->deleteMedia($media); // Fix for deleting the media from storage also.

        return redirect(route($this->path.'.edit', $id).'#fotos')->with('flash_message', 'Media removed succesfully.');
    }

    public function mediaDefault($id, Media $media)
    {
        // $record = $this->repo->find($id);
        // $medias = $record->media()->get()->puck('id');

        $media->order_column = 1;
        $media->save();


        return redirect(route($this->path.'.edit', $id).'#fotos')->with('flash_message', 'Media updated succesfully.');
    }
}
