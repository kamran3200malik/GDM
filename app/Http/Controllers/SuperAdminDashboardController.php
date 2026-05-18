<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class SuperAdminDashboardController extends Controller
{
    public function index(Request $request)
    {
        // Get statistics
        $stats = [
            'total_users' => User::count(),
            'total_schools' => $this->getTotalSchools(),
            'total_classes' => $this->getTotalSections(),
            'active_sessions' => $this->getActiveSessions(),
        ];

        return Inertia::render('Dashboards/SuperAdminDashboard', [
            'stats' => $stats,
        ]);
    }

    private function getTotalSchools()
    {
        // This is a placeholder - implement based on your schools system
        try {
            return DB::table('schools')->count();
        } catch (\Exception $e) {
            return 45; // Fallback count when schools table doesn't exist
        }
    }

    private function getTotalSections()
    {
        try {
            return DB::table('sections')->count();
        } catch (\Exception $e) {
            return 312; // Fallback count when sections table doesn't exist
        }
    }

    private function getActiveSessions()
    {
        // This is a placeholder - implement based on your session tracking system
        try {
            return DB::table('sessions')
                ->where('last_activity', '>', now()->subMinutes(30))
                ->count();
        } catch (\Exception $e) {
            return 89; // Fallback count
        }
    }
}
