<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Super Admin',
                'email' => 'superadmin@1000hpk',
                'password' => bcrypt('superadmin'),
                'role' => 'superadmin',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Admin',
                'email' => 'admin@1000hpk',
                'password' => bcrypt('admin'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'User',
                'email' => 'user@1000hpk',
                'password' => bcrypt('user'),
                'role' => 'user',
                'email_verified_at' => now(),
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
