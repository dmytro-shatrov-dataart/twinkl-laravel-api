<?php

namespace Database\Factories;

use App\Models\BannedIp;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<BannedIp>
 */
class BannedIpFactory extends Factory
{
    public function definition(): array
    {
        return [
            'address' => $this->faker->unique()->ipv4(),
        ];
    }
}
