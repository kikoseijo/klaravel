<?php

namespace Ksoft\Klaravel\Http\Controllers;

use Illuminate\Contracts\Pagination\Paginator;

use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class ActivitylogController extends Controller
{

    public function index(Request $request)
    {
        $logItems = $this->getPaginatedActivityLogItems($request);
        $logsTags = Activity::distinct()->select('log_name')->get()->pluck('log_name');
        $logSubjects = Activity::distinct()->select('subject_type')->whereNotNull('subject_type')->get()->pluck('subject_type');

        return view('klaravel::admin.activitylog', compact('logItems', 'logsTags', 'logSubjects'));
    }

    public function destroy(Activity $activity)
    {
        $activity->delete();
        return back()->with('flash_message', 'Activity log delete succesfully');
    }

    protected function getPaginatedActivityLogItems($request): Paginator
    {
        $query = Activity::with('causer')->orderBy('created_at', 'DESC');

        if ($request->filled('tag')) {
            $query->inLog($request->tag);
        }

        if ($request->filled('subject')) {
            $query->where('subject_type', $request->subject);
        }

        if ($request->filled('q')) {
            $query->where( 'description', 'LIKE', '%'. $request->q .'%');
        }

        return $query->paginate(session(config('ksoft.CONSTANTS.take', 'PER_PAGE'), 25));
    }
}
