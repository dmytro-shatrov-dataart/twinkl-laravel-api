<?php

namespace Database\Factories;

use App\Enum\UserTypeEnum;
use App\Models\Subscription;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Subscription>
 */
class SubscriptionFactory extends Factory
{
    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->unique()->email(),
            'user_type' => $this->faker->randomElement(UserTypeEnum::cases()),
        ];
    }
}
