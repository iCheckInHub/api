<?php

namespace Database\Factories;

use App\Models\MenuService;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderItem>
 */
class OrderItemFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition()
  {
    return [
      'quantity' => fake()->numberBetween(1, 3),
      'service_id' => MenuService::all()->random()->id,
    ];
  }
}
