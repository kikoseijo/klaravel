<?php

namespace Ksoft\Klaravel\Http\Controllers;

use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Spatie\Activitylog\Models\Activity;

class ActivitylogController extends Controller
{

    public function index(Request $request)
    {
        if (!Schema::hasTable('activity_log')) {
            $installUrl = route('kLara.publish') . '?file=activity_log';
            $installBtn = '<a href="'.$installUrl.'" class="btn btn-primary btn-sm ml-3">Create activity logs table</a>';
            return back()->with('flash_error', 'Sorry, <strong>activity_log</strong> table does not exists.' .$installBtn);
        }
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

    public function massDestroy(Request $request)
    {
        $res = '';

        if ($request->filled('clean_all') && $request->get('clean_all') == 'yes') {
            $allRecords = Activity::where('id', '>', 0)->delete();
            return back()->with('flash_message', 'Succesfully deleted <strong>' . $allRecords . '</strong> record/s.');
        }

        if ($request->filled('del_tag') && $request->filled('del_subject')) {
            $query = Activity::where('log_name', $request->del_tag);
            if ($request->query_type == 'OR') {
                $tags = $query->orWhere('subject_type', $request->del_subject)->delete();
            } else {
                $tags = $query->where('subject_type', $request->del_subject)->delete();
            }
            $res .= ' Deleted <strong>' . $tags . '</strong> logs by matching query.';
        } else {
            if ($request->filled('del_tag')) {
                $tags = Activity::where('log_name', $request->get('del_tag'))->delete();
                $res .= ' Deleted <strong>' . $tags . '</strong> logs by TAG.';
            }

            if ($request->filled('del_subject')) {
                $subjects = Activity::where('subject_type', $request->get('del_subject'))->delete();
                $res .= ' Deleted <strong>' . $subjects . '</strong> logs by Subject...';
            }
        }

        return back()->with('flash_message', 'Mass deletion succesfull.' . $res);
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
            $query->where('description', 'LIKE', '%' . $request->q . '%');
        }

        return $query->paginate(session(config('ksoft.CONSTANTS.take', 'PER_PAGE'), 25));
    }
}
