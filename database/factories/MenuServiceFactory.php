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
      'name' => $this->faker->name,
      'description' => $this->faker->text,
      'image' => $this->faker->imageUrl(480, 480, 'service', true),
      'price' => $this->faker->randomFloat(2, 1, 20),
      'duration' => $this->faker->numberBetween(0, 30),
      'top' => $this->faker->boolean,
    ];
  }
}
