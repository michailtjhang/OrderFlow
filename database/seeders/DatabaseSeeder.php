<?php

namespace Database\Seeders;

use Carbon\Carbon;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        DB::table('users')->insert([
            [
                'id' => '1',
                'id_user' => 'US001',
                'name' => 'Admin',
                'nim' => NULL,
                'email' => 'admin@gmail.com',
                'role' => 'admin',
                'email_verified_at' => NULL,
                'password' => '$2y$12$eaHr3KoP3gazDWn/d4ZYL.zvjvMSTLUhNyDLEQEsH8OJAP455w3Fu', // Encrypted password
                'remember_token' => NULL,
                'created_at' => Carbon::parse('2024-05-07 13:00:18'),
                'updated_at' => Carbon::parse('2024-05-07 13:00:18'),
            ],
        ]);
    }
}
