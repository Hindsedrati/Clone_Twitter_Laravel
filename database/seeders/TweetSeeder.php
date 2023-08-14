<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TweetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'test',
            'pseudo' => '@LeGrizzly',
            'email' => 'test@tw.com',
            'role_id' => 1,
            'email_verified_at' => NULL,
            'password' => '$2y$10$kAvjAQAOD9rWaHN.VM/3B.5OxTpPLWaY/UgcifueZfTeVHrnndT8i',
            'remember_token' => NULL,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('users')->insert([
            'name' => 'test',
            'pseudo' => '@mathilde',
            'email' => 'test2@tw.com',
            'role_id' => 1,
            'email_verified_at' => NULL,
            'password' => '$2y$10$kAvjAQAOD9rWaHN.VM/3B.5OxTpPLWaY/UgcifueZfTeVHrnndT8i',
            'remember_token' => NULL,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('tweets')->insert([
            'user_id' => '2',
            'image' => '',
            'tweet' => "tweet 1",
            'file' => '',
            'is_video' => 0,
            'comments' => '35',
            'retweets' => '54',
            'likes' => '88',
            'analytics' => '81',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('tweets')->insert([
            'user_id' => '3',
            'image' => '',
            'tweet' => "tweet 2",
            'file' => '',
            'is_video' => 0,
            'comments' => '35',
            'retweets' => '54',
            'likes' => '88',
            'analytics' => '81',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        
    }
}