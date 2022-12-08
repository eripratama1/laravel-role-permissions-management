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

     
        /**
         * Memanggil RoleSeeder untuk menambahkan list role ke tabel roles
         * Membuat user baru sekaligus menambahkan role 'SuperAdmin'
         * pada user tersebut.
         */
        $this->call(RoleSeeder::class);

        $user = User::create([
            'name' => 'Super Admin',
            'email' => 'admin@email.test',
            'password' => bcrypt('password'),
        ]);

        $user->assignRole('SuperAdmin');
    }
}
