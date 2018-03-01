<?php
namespace Ksoft\Klaravel\Http\Controllers;

use Ksoft\Klaravel\Models\Cache;

class CacheController extends Controller
{

    public function index()
    {
        $records = Cache::orderBy('expiration', 'DESC')
                    ->paginate(session(config('ksoft.CONSTANTS.take', 'PER_PAGE'), 50));

        return view('klaravel::admin.cache', compact('records'));
    }

    public function delete(Cache $cache)
    {
        $cache->delete();

        return back()->with('flash_message', 'Caché value deleted.');
    }
}
