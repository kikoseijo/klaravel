<?php namespace Ksoft\Klaravel\Traits;

use Illuminate\Http\Request;


trait CanSortRecords
{

    public function sortRecord($id, $action = 'up')
    {
        $record = $this->repo->find($id);
        switch ($action) {
            case 'up':
                $record->moveOrderUp();
                break;
            case 'down':
                $record->moveOrderDown();
                break;
            case 'first':
                $record->moveToStart();
                break;
            case 'last':
                $record->moveToEnd();
                break;
        }

        return back()->with('flash_message','Record moved succesfully');
    }
}
