<?php

namespace App\Http\Controllers%subfolder%;

use App\Interactions%subfolder%\%model%Create;
use App\Interactions%subfolder%\%model%Update;
use App\Repositories%subfolder%\%model%Repository;
use App\DataTables%subfolder%\%model%DataTable;
use Illuminate\Http\Request;

/**
 * Class %model%Controller
 * @package App\Http\Controllers%subfolder%\%model%Controller
 */
class %model%Controller extends BaseCtrl
{
    public function __construct(%model%Repository $repo)
    {
        $this->createInteraction = %model%Create::class;
        $this->updateInteraction = %model%Update::class;

        parent::__construct('%model_name_url%', $repo);
    }

    /**
     * Prepare for DataTables
     */
    public function indexPRE(Request $request)
    {
        $res = array_merge($this->loadCrudStyles(), [
            'model_name' => $this->path,
        ]);

        return (new %model%DataTable)->render('back._base.data-table', $res);
    }

    /**
     * Injects extra data to views.
     */
    protected function getExtraData(): array
    {
        return [];
    }

}
