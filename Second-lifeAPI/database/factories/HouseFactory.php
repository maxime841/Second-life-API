<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\House>
 */
class HouseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "name" =>fake()->name(),
            "owner" => fake()->name(),
            "presentation" =>fake()->text(),
            "prims" => fake()->numberBetween(0, 1000000),
            "remaining_house_prims" => fake()->numberBetween(0, 1000000),
            "date_start_rent" => fake()->dateTime(),
            "date_end_rent" => fake()->dateTime(),
            "tenant_id" => fake()->numberBetween(0, 1000000),
        ];
    }
}
