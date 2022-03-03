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
            'title' => $this->faker->realText($maxNbChars=rand($min=10, $max=60)),
            'message' => $this->faker->realText($maxNbChars=rand($min=20, $max=5000)),
            // 'image' => $this->faker->optional($weight = 0.3)->image($dir = storage_path('app/public')),
            'image' => $this->faker->optional($weight = 0.3)->imageUrl(),
            'public' => $this->faker->boolean($chanceOfGettingTrue = 70),
            'user_id' => User::pluck('id')->random()
        ];
    }
}
