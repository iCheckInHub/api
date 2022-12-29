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
      'name' => $this->faker->name,
      'description' => $this->faker->text,
      'image' => $this->faker->imageUrl(640, 480, 'cats', true),
      'multiple' => $this->faker->boolean,
    ];
  }
}
