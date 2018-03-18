<?php
namespace Ksoft\Klaravel\Http\Controllers;

use Ksoft\Klaravel\Models\Session;

use Illuminate\Http\Request;

use Illuminate\Support\Carbon;

class SessionController extends Controller
{

    public function index(Request $request)
    {
        $query = $this->filterDates($request);

        $sessions = $query->paginate(session(config('ksoft.CONSTANTS.take', 'PER_PAGE'), 50));

        return view('klaravel::admin.sessions', compact('sessions'));
    }

    public function delete(Session $session)
    {
        $session->delete();

        return back()->with('flash_message', 'Record deleted.');
    }

    protected function filterDates($request)
    {
        $query = Session::orderBy('last_activity', 'DESC');

        if ($request->filled('limit')) {
            if ($request->get('limit') == 'X') {
                session()->forget(SESSION_TIME_LIMIT_CACHE);
            } else {
                $tlimit = $request->get('limit');
                session([SESSION_TIME_LIMIT_CACHE => $tlimit]);
            }
        } else {
            $tlimit = session(SESSION_TIME_LIMIT_CACHE);
        }

        if (!isset($tlimit) or is_null($tlimit)) {
            return $query;
        }

        $tLAr = explode('-', $tlimit);

        switch (array_get($tLAr,1)) {
            case 'm':
                return $query->where('last_activity', '>', now()->subMinutes($tLAr[0])->timestamp);
                break;
            case 'h':
                return $query->where('last_activity', '>', now()->subHours($tLAr[0])->timestamp);
                break;
            default:
                return $query;
                break;
        }
    }
}
