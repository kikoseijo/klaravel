<?php namespace Ksoft\Klaravel\Traits;

use Illuminate\Http\Request;
use Spatie\MediaLibrary\Media;

/**
 * Trait CanChangeStatuses.
 * ----------------
 * CONTROLLER
 * ----------------
 * protected $changeableStatus = [
 *           'active' => 'bool', // for booleans you can send 'true', 'on' or '1'
 *           'status' => ['A','B','C'] // for enums, must exist in array.
 *       ];
 * ----------------
 * Routes
 * ----------------
 * Route::get('MODEL/change-status/{id}/{key}/{status}/', 'YOUR__Controller@changeStatus')->name('MODEL.status_change');
 * ----------------
 * BLADE
 * ----------------
 * <a href="{{route_has($model_name.'.status_change',[$item->id,'active', $item->active ? '0' : '1'])}}">
 *  <i class="far fa-circle text-{{ $item->active ? 'success' : 'danger' }}"></i>
 * </a>
 */
trait CanChangeStatuses
{

    public function changeStatus($id, $key, $status)
    {
        $record = $this->repo->find($id);
        if (!$record) {
            return back()->with('flash_error', 'Could not find the record by ID.');
        }


        $statusKey = array_get($this->changeableStatus, $key);
        if ($statusKey == 'bool') {
            $newStatus =  $status || $status == 'true' || mb_strtolower($status) == 'on' ? 1 : 0;
        } elseif (is_array($statusKey)) {
            if (in_array($status, $statusKey)) {
                $newStatus = $status;
            } else {
                return back()->with('flash_error', 'Sorry you trying to change a key: '.$key.' for a non declared value');
            }
        } else {
            return back()->with('flash_error', 'Sorry you trying to change a non declared key: '.$key);
        }

        $record->{$key} = $newStatus;
        $record->save();

        // $logEstados = ['Off', 'On'];
        //
        // $logEvent = "Cambio de estado $key = " .$logEstados[$newStatus];
        // activity()->on($record)->log($logEvent);

        return back()->with('flash_message','Status changed succesfully!');
    }
}
