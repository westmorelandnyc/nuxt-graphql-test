<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Job>
 */
class JobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $randomWord = $this->faker->word;
        $companySuffix = $this->faker->companySuffix;
        
        $companyName = ucfirst($randomWord) . ' ' . ucfirst($companySuffix);

        return [
            'name' => $companyName,
            'project_manager' => User::factory(),
        ];
    }
}
