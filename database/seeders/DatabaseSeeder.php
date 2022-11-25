<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // $this->call(PostSeeder::class);
        // $this->call(RoleSeeder::class);

        $user = User::create([
            'name' => 'Super Admin',
            // 'username' => 'superadmin',
            'email' => 'admin@email.test',
            'password' => bcrypt('password'),
        ]);

        $user->assignRole('SuperAdmin');
    }
}
