<?php
namespace Ksoft\Klaravel\Http\Controllers;


class KlaravelController extends Controller
{

    public function index()
    {
        // $records = Cache::orderBy('expiration', 'DESC')
        //             ->paginate(session(config('ksoft.CONSTANTS.take', 'PER_PAGE'), 50));

        return view('klaravel::_kLara.dashboard');
    }

    public function delete(Cache $cache)
    {
        $cache->delete();

        return back()->with('flash_message', 'Caché value deleted.');
    }
}
