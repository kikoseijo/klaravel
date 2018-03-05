<?php namespace Ksoft\Klaravel\Traits;

use Illuminate\Http\Request;
use Spatie\MediaLibrary\Media;

/**
* Trait CanUploadMedia.
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
        $media->delete();
        return redirect(route($this->path.'.edit', $id).'#fotos')->with('flash_message', 'Media removed succesfully.');
    }
}
