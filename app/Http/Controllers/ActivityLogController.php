<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Services\ActivityLogService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ActivityLogController extends Controller
{
    public function index(Request $request)
    {
        $logs = ActivityLog::with('user')
            ->when($request->module, function ($query, $module) {
                $query->where('module', $module);
            })
            ->when($request->action, function ($query, $action) {
                $query->where('action', $action);
            })
            ->when($request->search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('description', 'like', "%{$search}%")
                      ->orWhereHas('user', function ($userQuery) use ($search) {
                          $userQuery->where('name', 'like', "%{$search}%");
                      });
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(50);

        $modules = ActivityLog::distinct()->pluck('module');
        $actions = ActivityLog::distinct()->pluck('action');

        return Inertia::render('Settings/ActivityLogs/Index', [
            'logs' => $logs,
            'modules' => $modules,
            'actions' => $actions,
            'filters' => $request->only(['module', 'action', 'search']),
        ]);
    }
}
