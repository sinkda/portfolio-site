<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->words(rand(2, 4), true),
            'description' => $this->faker->sentences(rand(2,5), true),
            'image' => $this->faker->imageUrl(640, 480, 'PHP', true),
            'links' => $this->faker->url()
        ];
    }
}
