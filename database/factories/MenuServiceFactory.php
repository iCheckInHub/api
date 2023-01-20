<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Menu>
 */
class MenuServiceFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition()
  {
    return [
      'name' => fake()->name,
      'description' => fake()->text,
      'image' => fake()->imageUrl(480, 480, 'service', true),
      'price' => fake()->randomFloat(2, 1, 10),
      'duration' => fake()->numberBetween(0, 10),
      'top' => fake()->boolean,
    ];
  }
}
