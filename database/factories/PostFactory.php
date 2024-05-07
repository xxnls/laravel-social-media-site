<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        //Get random, active user id
        $user_id = DB::table('users')
            ->select('id')
            ->where('is_active', 1)
            ->inRandomOrder()
            ->limit(1)
            ->value('id');

        return [
            'content' => $this->faker->sentence(),
            'user_id' => $user_id
        ];
    }
}
