<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\Place;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlaceSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    Place::factory()
      ->count(2)
      ->has(Menu::factory()->count(2)->has(Menu::factory()->count(3)))
      ->create();
  }
}
