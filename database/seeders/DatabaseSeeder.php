<?php

namespace Database\Seeders;

use App\Models\Feedback;
use App\Models\User;
use App\Models\Listing;
use App\Models\Platform;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

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

        $user = User::factory()->create([
            'username' => 'customer1',
            'email' => 'cus@mail',
            'password' => bcrypt('123123123'),
            'role' => 0
        ]);

        $user = User::factory()->create([
            'username' => 'customer2',
            'email' => 'cus@mail1',
            'password' => bcrypt('123123123'),
            'role' => 0
        ]);

        $user = User::factory()->create([
            'username' => 'customer3',
            'email' => 'cus@mail2',
            'password' => bcrypt('123123123'),
            'role' => 0
        ]);

        $user = User::factory()->create([
            'username' => 'admin',
            'email' => 'admin@mail',
            'password' => bcrypt('123123123'),
            'role' => 1
        ]);

        Platform::factory()->create([
            'platname' => 'PC'
        ]);

        Platform::factory()->create([
            'platname' => 'Playstation'
        ]);

        Platform::factory()->create([
            'platname' => 'Xbox'
        ]);

        Platform::factory()->create([
            'platname' => 'Nintendo'
        ]);

        User::factory(1)->create();
        Listing::factory(50)->create();
        Feedback::factory(50)->create();

        // foreach (Listing::all() as $listing) {
        //     $users = User::inRandomOrder()->take(rand(1, 3))->pluck('id');
        //     $listing->carts()->attach($users);
        // }
    }
}
