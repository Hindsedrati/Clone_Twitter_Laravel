<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Analytic;

class Analytics extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Analytic::factory()->count(10)->create();
    }
}
