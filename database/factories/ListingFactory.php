<?php

namespace Database\Factories;

use App\Models\Platform;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Listing>
 */
class ListingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(),
            'price' => $this->faker->randomFloat(2, 10, 100),
            'tags' => $this->faker->randomElement(
                ['Adventure', 'Action', "Beat'em-all", 'Early-Access', 'FPS', 'Multiplayer', 'Indies', 'Online', 'RPG', 'Sport', 'Simulation', 'Strategy', 'Single-player', 'Other']
            ),
            // 'platforms' => $this->faker->randomElement(['PC', 'Playstation', 'Xbox', 'Nintendo']),
            'description' => $this->faker->paragraph(5),
            'user_id' => User::where('role', 1)->get()->random()->id,
            'plat_id' => Platform::all()->random()->id
        ];
    }
}
