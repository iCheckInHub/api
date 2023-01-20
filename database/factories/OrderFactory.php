<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Employee;
use App\Models\Order;
use App\Models\Place;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition()
  {
    return [
      'customer_id' => Customer::inRandomOrder()->first()->id,
      'place_id' => Place::inRandomOrder()->first()->id,
      'employee_id' => Employee::role('employee')->inRandomOrder()->first()->id,
      'status' => fake()->randomElement(['pending', 'confirmed', 'canceled', 'completed']),
    ];
  }
}
