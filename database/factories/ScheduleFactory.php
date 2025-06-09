<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Schedule>
 */
class ScheduleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startTime = fake()->dateTimeBetween('now', '+1 month');
        $endTime = fake()->dateTimeBetween($startTime, $startTime->format('Y-m-d H:i:s') . ' +4 hours');

        return [
            'user_id' => User::factory(),
            'title' => fake()->sentence(3),
            'description' => fake()->paragraph(),
            'start_time' => $startTime,
            'end_time' => $endTime,
            'location' => fake()->optional()->address(),
            'is_recurring' => fake()->boolean(20), // 20% chance of being recurring
            'recurrence_pattern' => fake()->optional(0.2)->randomElement(['daily', 'weekly', 'monthly', 'yearly']),
            'status' => fake()->randomElement(['active', 'completed', 'cancelled']),
            'priority' => fake()->randomElement(['low', 'medium', 'high']),
            'kingschat_notification' => fake()->boolean(30), // 30% chance of KingsChat notification
        ];
    }

    /**
     * Indicate that the schedule is active.
     */
    public function active(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'active',
        ]);
    }

    /**
     * Indicate that the schedule is completed.
     */
    public function completed(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'completed',
        ]);
    }

    /**
     * Indicate that the schedule is high priority.
     */
    public function highPriority(): static
    {
        return $this->state(fn (array $attributes) => [
            'priority' => 'high',
        ]);
    }

    /**
     * Indicate that the schedule has KingsChat notification enabled.
     */
    public function withKingsChatNotification(): static
    {
        return $this->state(fn (array $attributes) => [
            'kingschat_notification' => true,
        ]);
    }

    /**
     * Indicate that the schedule is recurring.
     */
    public function recurring(string $pattern = 'weekly'): static
    {
        return $this->state(fn (array $attributes) => [
            'is_recurring' => true,
            'recurrence_pattern' => $pattern,
        ]);
    }

    /**
     * Indicate that the schedule is upcoming.
     */
    public function upcoming(): static
    {
        $startTime = fake()->dateTimeBetween('+1 day', '+1 month');
        $endTime = fake()->dateTimeBetween($startTime, $startTime->format('Y-m-d H:i:s') . ' +4 hours');

        return $this->state(fn (array $attributes) => [
            'start_time' => $startTime,
            'end_time' => $endTime,
            'status' => 'active',
        ]);
    }
}
