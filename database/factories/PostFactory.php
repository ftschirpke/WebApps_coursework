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
            'message' => $this->faker->realText($maxNbChars=rand($min=20, $max=200)),
            'image' => $this->faker->optional($weight = 0.3)->image(),
            'public' => $this->faker->boolean($chanceOfGettingTrue = 70),
            'user_id' => User::pluck('id')->random()
        ];
    }
}
