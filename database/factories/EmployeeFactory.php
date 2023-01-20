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
      'name' => $this->faker->name,
      'email' => $this->faker->unique()->safeEmail,
      'email_verified_at' => now(),
      'password' => Hash::make('123456'),
      'avatar' => $this->faker->imageUrl(200, 200),
      'code' => $this->faker->unique()->randomNumber(6),
      'phone' => $this->faker->unique()->phoneNumber,
      'address' => $this->faker->address,
      'birthday' => $this->faker->dateTimeBetween('-30 years', '-18 years'),
      'gender' => $this->faker->randomElement(['male', 'female']),
      'username' => $this->faker->unique()->userName,
    ];
  }
}
