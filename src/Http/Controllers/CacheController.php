<?php
namespace Ksoft\Klaravel\Http\Controllers;

use Illuminate\Support\Facades\Schema;
use Ksoft\Klaravel\Models\Cache;

class CacheController extends Controller
{

    public function index()
    {
        if (!Schema::hasTable('cache')) {
            $installUrl = route('kLara.publish') . '?file=table&table=cache';
            $installBtn = '<a href="'.$installUrl.'" class="btn btn-primary btn-sm ml-3">Create Cache table</a>';
            return back()->with('flash_error', 'Sorry, <strong>cache</strong> table does not exists.'.$installBtn);
        }

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
