<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class UmrahPackageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->paragraph,
            'price' => $this->faker->numberBetween(1000000, 20000000),
            'image' => $this->faker->imageUrl(),
        ];
    }
}
