<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CreateUserSeeder extends Seeder
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
                'username' => 'Customer1',
                'email' => 'cus@mail',
                'password' => bcrypt('123123123'),
                'role' => 0
            ],
            [
                'username' => 'Admin1',
                'email' => 'admin@mail',
                'password' => bcrypt('123123123'),
                'role' => 1
            ]
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
