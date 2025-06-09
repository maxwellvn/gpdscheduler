<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display the dashboard.
     */
    public function index(): View
    {
        $user = Auth::user();
        
        // Get upcoming schedules (next 7 days)
        $upcomingSchedules = $user->schedules()
            ->where('start_time', '>=', now())
            ->where('start_time', '<=', now()->addDays(7))
            ->where('status', 'active')
            ->orderBy('start_time', 'asc')
            ->limit(5)
            ->get();

        // Get today's schedules
        $todaySchedules = $user->schedules()
            ->whereDate('start_time', today())
            ->where('status', 'active')
            ->orderBy('start_time', 'asc')
            ->get();

        // Get statistics
        $stats = [
            'total_schedules' => $user->schedules()->count(),
            'active_schedules' => $user->schedules()->where('status', 'active')->count(),
            'completed_schedules' => $user->schedules()->where('status', 'completed')->count(),
            'kingschat_notifications' => $user->schedules()->where('kingschat_notification', true)->count(),
        ];

        return view('dashboard', compact('upcomingSchedules', 'todaySchedules', 'stats'));
    }
}
