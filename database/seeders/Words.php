<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Word;

class Words extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Word::factory()->count(10)->create();

        $arrWords = [
            'hello',
            'world',
            'goodbye',
            'twitter',
            'facebook',
        ];

        foreach ($arrWords as $word) {
            DB::table('words')->insert([
                'word' => $word,
                'user_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }
    }
}
