<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Place;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        fn ($sequence) => [
          'user_id' => User::all()->random()->id,
          'place_id' => Place::all()->random()->id,
        ],
      ))
      // ->for(User::all()->random(), 'user')
      // ->for(Place::all()->random(), 'place')
      ->hasItems(rand(3, 5))
      ->create();
  }
}
