<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class AdminDashboardController extends Controller
{
    public function index(Request $request)
    {
        // Get statistics
        $stats = [
            'total_students' => User::whereHas('role', function($query) {
                $query->where('name', 'student');
            })->count(),
            'total_teachers' => User::whereHas('role', function($query) {
                $query->where('name', 'teacher');
            })->count(),
            'total_classes' => $this->getTotalSections(),
            'avg_attendance' => $this->getAverageAttendance(),
        ];

        // Get recent activities
        $recentActivities = $this->getRecentActivities();

        return Inertia::render('Dashboards/AdminDashboard', [
            'stats' => $stats,
            'recentActivities' => $recentActivities,
            'userRole' => $request->user()->getRoleLabel(),
        ]);
    }

    private function getTotalSections()
    {
        try {
            return DB::table('sections')->count();
        } catch (\Exception $e) {
            return 24; // Fallback count when sections table doesn't exist
        }
    }

    private function getAverageAttendance()
    {
        // This is a placeholder - implement based on your attendance system
        try {
            return DB::table('attendances')
                ->where('status', 'present')
                ->count() / max(DB::table('attendances')->count(), 1) * 100;
        } catch (\Exception $e) {
            return 92; // Fallback percentage
        }
    }

    private function getRecentActivities()
    {
        $activities = [];
        
        // Get recent user registrations
        $recentUsers = User::latest()->take(3)->get();
        foreach ($recentUsers as $user) {
            $activities[] = [
                'id' => $user->id,
                'type' => 'user_registration',
                'message' => "New {$user->getRoleLabel()} registration: {$user->name}",
                'time' => $user->created_at->diffForHumans(),
                'icon' => 'user',
                'color' => 'blue'
            ];
        }

        // Add some placeholder activities for demo
        $activities[] = [
            'id' => 'activity_1',
            'type' => 'report',
            'message' => 'Attendance report generated for Class 10A',
            'time' => '5 hours ago',
            'icon' => 'check',
            'color' => 'green'
        ];

        $activities[] = [
            'id' => 'activity_2',
            'type' => 'system',
            'message' => 'System settings updated',
            'time' => '1 day ago',
            'icon' => 'settings',
            'color' => 'purple'
        ];

        return array_slice($activities, 0, 5);
    }

    public function getStudents(Request $request)
    {
        $students = User::whereHas('role', function($query) {
            $query->where('name', 'student');
        })->with('role')->paginate(10);

        return response()->json($students);
    }

    public function getTeachers(Request $request)
    {
        $teachers = User::whereHas('role', function($query) {
            $query->where('name', 'teacher');
        })->with('role')->paginate(10);

        return response()->json($teachers);
    }
}
