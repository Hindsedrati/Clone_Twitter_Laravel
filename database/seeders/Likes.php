<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Like;

class Likes extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Like::factory()->count(50)->create();
    }
}
