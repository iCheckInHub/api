<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
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
      'email' => fake()->unique()->userName . '@employee.com',
      'email_verified_at' => now(),
      'password' => Hash::make('123456'),
      'avatar' => fake()->imageUrl(200, 200),
      'code' => fake()->unique()->randomNumber(6),
      'phone' => fake()->e164PhoneNumber(),
      'address' => fake()->address,
      'birthday' => fake()->dateTimeBetween('-30 years', '-18 years'),
      'gender' => fake()->randomElement(['male', 'female']),
      'username' => fake()->unique()->userName,
    ];
  }
}
