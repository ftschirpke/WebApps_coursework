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
            'title' => $this->faker->realText($maxNbChars=rand(5, 60)),
            'message' => $this->faker->realText($maxNbChars=rand(20, 5000)),
            'image' => $this->faker->optional($weight=0.3)->imageUrl(),
            // images are optional - 30% of the posts will have images
            'public' => $this->faker->boolean($chanceOfGettingTrue=70),
            // not all posts are public - 70% of the posts will be public
            'user_id' => User::pluck('id')->random()
        ];
    }
}
