<?php namespace Ksoft\Klaravel\Traits;

use Illuminate\Http\Request;
use Spatie\MediaLibrary\Media;

trait CanChangeStatuses
{

    public function changeStatus($id, $key, $status)
    {
        $record = $this->repo->find($id);

        if (!$record) {
            return back()->with('flash_error', 'Could not find record.');
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

        return back()->with('flash_message','Status changed succesfully!');
    }
}
