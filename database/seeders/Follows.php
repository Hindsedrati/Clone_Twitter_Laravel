<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Follow;

class follows extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Follow::factory()->count(10)->create();
    }
}
