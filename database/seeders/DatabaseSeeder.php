<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        User::factory()->create([
            'name' => 'Samuel Felipe',
            'email' => 'samfelgar@gmail.com',
            'password' => Hash::make(config('auth.default_password')),
        ]);
    }
}
