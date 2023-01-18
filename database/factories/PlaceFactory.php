<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Place>
 */
class PlaceFactory extends Factory
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
      'address' => $this->faker->address,
      'image' => $this->faker->imageUrl(640, 480, 'place', true),
      'cover' => $this->faker->imageUrl(640, 480, 'place', true),
      'description' => $this->faker->text,
      'phone' => $this->faker->phoneNumber,
      'hours' => json_encode("{'mon':'8:00 - 17:00'}"),
    ];
  }
}
