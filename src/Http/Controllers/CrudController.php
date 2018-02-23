<?php

namespace Ksoft\Klaravel\Http\Controllers;

use Illuminate\Http\Request;

class CrudController extends Controller
{

    public function swapPerPage(Request $request)
    {
        $perPageKey = config('klaravel.CONSTANTS.take', 'PER_PAGE');
        session([$perPageKey => $request->get('perPage')]);

        if ($request->filled('redirect')) {
            return redirect(url('/' . $request->redirect));
        }

        return back();
    }
}
