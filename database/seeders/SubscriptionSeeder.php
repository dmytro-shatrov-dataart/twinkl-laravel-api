<?php

namespace Database\Seeders;

use Database\Factories\SubscriptionFactory;
use Illuminate\Database\Seeder;

class SubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        (new SubscriptionFactory())->count(10)->create();
    }
}
