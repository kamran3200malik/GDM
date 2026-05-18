<?php

namespace App\Services;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Request;

class ActivityLogService
{
    public static function log($action, $module, $description = null, $oldValues = null, $newValues = null)
    {
        $user = auth()->user();
        
        if (!$user) {
            return;
        }

        ActivityLog::create([
            'user_id' => $user->id,
            'action' => $action,
            'module' => $module,
            'description' => $description,
            'old_values' => $oldValues,
            'new_values' => $newValues,
            'ip_address' => Request::ip(),
            'user_agent' => Request::userAgent(),
        ]);
    }

    public static function logCreated($module, $model, $description = null)
    {
        $description = $description ?? "Created new {$module}: {$model->name}";
        
        self::log(
            'created',
            $module,
            $description,
            null,
            $model->toArray()
        );
    }

    public static function logUpdated($module, $model, $oldValues, $description = null)
    {
        $description = $description ?? "Updated {$module}: {$model->name}";
        
        self::log(
            'updated',
            $module,
            $description,
            $oldValues,
            $model->toArray()
        );
    }

    public static function logDeleted($module, $model, $description = null)
    {
        $description = $description ?? "Deleted {$module}: {$model->name}";
        
        self::log(
            'deleted',
            $module,
            $description,
            $model->toArray(),
            null
        );
    }

    public static function logToggled($module, $model, $description = null)
    {
        $status = $model->is_active ? 'activated' : 'deactivated';
        $description = $description ?? "Toggled {$module} status: {$model->name} - {$status}";
        
        self::log(
            'toggled',
            $module,
            $description,
            ['is_active' => !$model->is_active],
            ['is_active' => $model->is_active]
        );
    }

    public static function getRecentActivities($limit = 50, $module = null)
    {
        $query = ActivityLog::with('user')
            ->orderBy('created_at', 'desc')
            ->limit($limit);

        if ($module) {
            $query->where('module', $module);
        }

        return $query->get();
    }

    public static function getActivitiesByModule($module, $limit = 100)
    {
        return ActivityLog::with('user')
            ->where('module', $module)
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }
}
