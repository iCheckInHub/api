<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\Menu;
use App\Models\MenuItem;
use App\Models\MenuService;
use App\Models\MenuServiceExtra;
use App\Models\MenuServiceExtraOption;
use App\Models\Place;
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
      ->count(rand(3, 5))
      ->hasAttached(Employee::all()->random(10))
      ->has(
        Menu::factory()->count(rand(2, 3))
          ->has(
            MenuItem::factory()->count(rand(2, 3))
              ->has(
                MenuService::factory()->count(rand(3, 7))
                  ->has(
                    MenuServiceExtra::factory()->count(rand(2, 3))
                      ->has(
                        MenuServiceExtraOption::factory()->count(rand(2, 3)),
                        'options'
                      ),
                    'extras'
                  ),
                'services'
              ),
            'items'
          ),
      )->create();
  }
}
