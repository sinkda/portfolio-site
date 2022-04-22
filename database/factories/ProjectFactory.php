<?php

namespace Database\Factories;

use Illuminate\Support\Str;
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
        $name = $this->faker->words(rand(2,4), true);
        $slug = Str::slug($name);
        $filename = $slug .'.png';

        return [
            'name' => $name,
            'description' => $this->faker->sentences(rand(2,5), true),
            'contribution' => $this->faker->sentences(rand(2,5), true),
            'image' => $filename,
            'live_link' => $this->faker->url(),
            'code_link' => $this->faker->url(),
            'slug' => $slug,
            'show' => false,
            'created_at' => $this->faker->dateTimeBetween('-1 week', now())
        ];
    }
}
