<?php

namespace Database\Factories;

use App\Models\Job;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DailyReport>
 */
class DailyReportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $date = $this->faker->dateTimeBetween(now()->addDays(1), now()->addDays(14))->format("Y-m-d");
        $job = Job::factory()->create();
        $foreman = User::factory()->foreman()->create();
        return [
            'name' => "{$job->name} - {$this->faker->word} - {$date}" ,
            'date' => $date,
            'foreman_id' => $foreman->id,
        ];
    }
}
