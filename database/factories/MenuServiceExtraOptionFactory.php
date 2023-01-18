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
      'name' => $this->faker->name,
      'description' => $this->faker->text,
      'image' => $this->faker->imageUrl(480, 480, 'extra', true, 'Faker'),
      'price' => $this->faker->randomFloat(2, 0, 5),
      'duration' => $this->faker->numberBetween(0, 30),
    ];
  }
}
