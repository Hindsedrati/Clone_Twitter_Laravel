<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;

class Users extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'LeGrizzly',
            'username' => 'LeGrizzly',
            'email' => 'test@tw.com',
            'role_id' => 3,
            'email_verified_at' => Carbon::now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => NULL,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'picture_path' => 'default_profile_picture.png',
            'banner_path' => '	default_profile_banner.png'
        ]);

        User::factory()->count(10)->create();

    }
}
