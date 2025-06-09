<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ScheduleController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the user's schedules.
     */
    public function index(): View
    {
        $schedules = Auth::user()->schedules()
            ->orderBy('start_time', 'asc')
            ->paginate(15);

        return view('schedules.index', compact('schedules'));
    }

    /**
     * Show the form for creating a new schedule.
     */
    public function create(): View
    {
        return view('schedules.create');
    }

    /**
     * Store a newly created schedule in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_time' => 'required|date|after:now',
            'end_time' => 'required|date|after:start_time',
            'location' => 'nullable|string|max:255',
            'is_recurring' => 'boolean',
            'recurrence_pattern' => 'nullable|string|in:daily,weekly,monthly,yearly',
            'priority' => 'required|string|in:low,medium,high',
            'kingschat_notification' => 'boolean',
        ]);

        $validated['user_id'] = Auth::id();

        Schedule::create($validated);

        return redirect()->route('schedules.index')
            ->with('success', 'Schedule created successfully!');
    }

    /**
     * Display the specified schedule.
     */
    public function show(Schedule $schedule): View
    {
        $this->authorize('view', $schedule);
        
        return view('schedules.show', compact('schedule'));
    }

    /**
     * Show the form for editing the specified schedule.
     */
    public function edit(Schedule $schedule): View
    {
        $this->authorize('update', $schedule);
        
        return view('schedules.edit', compact('schedule'));
    }

    /**
     * Update the specified schedule in storage.
     */
    public function update(Request $request, Schedule $schedule): RedirectResponse
    {
        $this->authorize('update', $schedule);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'location' => 'nullable|string|max:255',
            'is_recurring' => 'boolean',
            'recurrence_pattern' => 'nullable|string|in:daily,weekly,monthly,yearly',
            'status' => 'required|string|in:active,completed,cancelled',
            'priority' => 'required|string|in:low,medium,high',
            'kingschat_notification' => 'boolean',
        ]);

        $schedule->update($validated);

        return redirect()->route('schedules.index')
            ->with('success', 'Schedule updated successfully!');
    }

    /**
     * Remove the specified schedule from storage.
     */
    public function destroy(Schedule $schedule): RedirectResponse
    {
        $this->authorize('delete', $schedule);
        
        $schedule->delete();

        return redirect()->route('schedules.index')
            ->with('success', 'Schedule deleted successfully!');
    }

    /**
     * Mark schedule as completed.
     */
    public function complete(Schedule $schedule): RedirectResponse
    {
        $this->authorize('update', $schedule);
        
        $schedule->update(['status' => 'completed']);

        return redirect()->back()
            ->with('success', 'Schedule marked as completed!');
    }

    /**
     * Get schedules with KingsChat notifications enabled.
     */
    public function kingsChatNotifications(): View
    {
        $schedules = Auth::user()->schedules()
            ->withKingsChatNotification()
            ->upcoming()
            ->orderBy('start_time', 'asc')
            ->get();

        return view('schedules.kingschat-notifications', compact('schedules'));
    }
}
