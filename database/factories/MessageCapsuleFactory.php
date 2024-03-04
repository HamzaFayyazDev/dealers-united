<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MessageCapsule>
 */
class MessageCapsuleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'note' => $this->faker->sentence,
            'scheduled_opening_time' => now()->addDays(rand(1, 10)),
            'is_opened' => false,
        ];
    }

    public function withNoteAndScheduledOpeningTime(): array
    {
        return [
            'note' => $this->faker->sentence,
            'scheduled_opening_time' => now()->addDays(rand(1, 10))->format('Y-m-d H:i:s'),
        ];
    }

    public function opened(): self
    {
        return $this->state(function (array $attributes) {
            return [
                'scheduled_opening_time' => now()->subDays(5),
                'is_opened' => true,
            ];
        });
    }

    public function scheduledTimePassed(): self
    {
        return $this->state(function (array $attributes) {
            return [
                'scheduled_opening_time' => now()->subDays(5),
            ];
        });
    }
}
