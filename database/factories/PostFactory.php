<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\User;

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
    public function definition()
    {
        return [
            'message' => $this->faker->realText($maxNbChars=200),
            'image' => $this->faker->image(),
            'public' => $this->faker->boolean($chanceOfGettingTrue = 70),
            'user_id' => User::pluck('id')->random() // default value that will be overwritten in the seeder
        ];
    }
}
