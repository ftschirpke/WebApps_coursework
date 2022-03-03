<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Account>
 */
class AccountFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            
            'display_name' => $this->faker->userName(),
            'icon' => $this->faker->optional($weight = 0.6)
            // ->image($dir = storage_path('app/public'), $width=100, $height=100, 'cats'),
            ->imageUrl($width=100, $height=100, 'cats'),
        ];
    }
}
