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
      'name' => fake()->name,
      'address' => fake()->address,
      'image' => fake()->imageUrl(640, 480, 'place', true),
      'cover' => fake()->imageUrl(640, 480, 'place', true),
      'description' => fake()->text,
      'phone' => fake()->e164PhoneNumber(),
      'hours' => json_encode("{'mon':'8:00 - 17:00'}"),
    ];
  }
}
