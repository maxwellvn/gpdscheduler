<?php

namespace App\Policies;

use App\Models\Schedule;
use App\Models\User;

class SchedulePolicy
{
    /**
     * Determine whether the user can view any schedules.
     */
    public function viewAny(User $user): bool
    {
        return true; // Users can view their own schedules
    }

    /**
     * Determine whether the user can view the schedule.
     */
    public function view(User $user, Schedule $schedule): bool
    {
        return $user->id === $schedule->user_id || $user->isAdmin();
    }

    /**
     * Determine whether the user can create schedules.
     */
    public function create(User $user): bool
    {
        return true; // All authenticated users can create schedules
    }

    /**
     * Determine whether the user can update the schedule.
     */
    public function update(User $user, Schedule $schedule): bool
    {
        return $user->id === $schedule->user_id || $user->isAdmin();
    }

    /**
     * Determine whether the user can delete the schedule.
     */
    public function delete(User $user, Schedule $schedule): bool
    {
        return $user->id === $schedule->user_id || $user->isAdmin();
    }

    /**
     * Determine whether the user can restore the schedule.
     */
    public function restore(User $user, Schedule $schedule): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can permanently delete the schedule.
     */
    public function forceDelete(User $user, Schedule $schedule): bool
    {
        return $user->isAdmin();
    }
}
