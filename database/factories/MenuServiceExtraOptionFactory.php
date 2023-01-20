<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Option>
 */
class MenuServiceExtraOptionFactory extends Factory
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
      'image' => fake()->imageUrl(480, 480, 'extra', true, 'Faker'),
      'price' => fake()->randomFloat(2, 0, 5),
      'duration' => fake()->numberBetween(0, 30),
    ];
  }
}
