<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Extra>
 */
class MenuServiceExtraFactory extends Factory
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
      'image' => fake()->imageUrl(640, 480, 'cats', true),
      'multiple' => fake()->boolean,
    ];
  }
}
