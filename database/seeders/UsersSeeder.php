<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'id'             => 1,
                'name'           => 'Admin',
                'email'          => 'admin@admin.com',
                'password'       => bcrypt('password'),
                'stripe_id'      => 'cus_MsVIyUY9Jnplnm',
                'remember_token' => null,
            ],
        ];

        User::insert($users);
    }
}
