<?php

namespace Ksoft\Klaravel\Http\Controllers;

use Illuminate\Contracts\Pagination\Paginator;
use Spatie\Activitylog\Models\Activity;

class ActivitylogController extends Controller
{

    public function index()
    {
        $logItems = $this->getPaginatedActivityLogItems();
        return view('klaravel::admin.activitylog', compact('logItems'));
    }

    protected function getPaginatedActivityLogItems(): Paginator
    {
        return Activity::with('causer')
            ->orderBy('created_at', 'DESC')
            ->paginate(session(config('ksoft.CONSTANTS.take', 'PER_PAGE'), 25));
    }
}
