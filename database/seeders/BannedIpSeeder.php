<?php

namespace Database\Seeders;

use Database\Factories\BannedIpFactory;
use Illuminate\Database\Seeder;

class BannedIpSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        (new BannedIpFactory)->count(10)->create();
    }
}
