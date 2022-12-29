<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Menu;
use App\Models\MenuItem;
use App\Models\MenuService;
use App\Models\MenuServiceExtra;
use App\Models\MenuServiceExtraOption;
use App\Models\Place;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   *
   * @return void
   */
  public function run()
  {
    User::factory()
      ->count(rand(2, 5))
      ->has(Place::factory()
        ->count(rand(2, 5))
        ->has(Menu::factory()->count(rand(2, 3))
          ->has(
            MenuItem::factory()->count(rand(2, 3))
              ->has(
                MenuService::factory()->count(rand(5, 10))
                  ->has(
                    MenuServiceExtra::factory()->count(rand(3, 5))
                      ->has(
                        MenuServiceExtraOption::factory()->count(rand(3, 5)),
                        'options'
                      ),
                    'extras'
                  ),
                'services'
              ),
            'items'
          )))
      ->create();
  }
}
