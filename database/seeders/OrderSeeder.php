<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Employee;
use App\Models\Order;
use App\Models\Place;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    Order::factory()->count(100)
      ->state(new Sequence(
        ['status' => 'pending'],
        ['status' => 'confirmed'],
        ['status' => 'canceled'],
        ['status' => 'completed'],
      ))
      ->hasItems(rand(3, 5))
      ->create();
  }
}
