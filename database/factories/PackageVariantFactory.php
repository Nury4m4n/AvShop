<?php

namespace Database\Factories;

use App\Models\PackageVariant;
use Illuminate\Database\Eloquent\Factories\Factory;

class PackageVariantFactory extends Factory
{
    protected $model = PackageVariant::class;

    public function definition()
    {
        return [
            'umrah_package_id' => \App\Models\UmrahPackage::factory(),
            'variant' => $this->faker->word(),
            'price' => $this->faker->numberBetween(1000000, 20000000),
            'stock' => $this->faker->numberBetween(1, 100),
        ];
    }
}
