<?php

namespace Database\Factories;

use App\Models\SubLocation;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Village>
 */
class VillageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->streetAddress(),
            'sub_location_id' => random_int(1, 40),
            'creator' => User::first()->id
        ];
    }
}
