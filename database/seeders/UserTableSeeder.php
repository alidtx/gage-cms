<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
          User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@gage.mv.com',
            'email_verified_at' => now(),
            'password' => bcrypt('admin123'),
        ]);
    }
}