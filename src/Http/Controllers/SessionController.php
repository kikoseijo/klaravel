<?php
namespace Ksoft\Klaravel\Http\Controllers;

use Ksoft\Klaravel\Models\Session;

class SessionController extends Controller
{

    public function index()
    {
        $sessions = Session::orderBy('last_activity', 'DESC')
                    ->paginate(session(config('ksoft.CONSTANTS.take', 'PER_PAGE'), 50));
        
        return view('klaravel::admin.active-users', compact('sessions'));
    }

    public function delete(Session $session)
    {
        $session->delete();

        return back()->with('flash_message', 'Record deleted.');
    }
}
