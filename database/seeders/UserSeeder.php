<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    User::factory()->hasAttached(Role::findByName('admin', 'admin'))->count(10)->create();

    Customer::factory()->hasAttached(Role::findByName('customer', 'customer'))->count(50)->create();

    Employee::factory()->hasAttached(Role::findByName('owner', 'employee'))->count(21)->create();
    Employee::factory()->hasAttached(Role::findByName('employee', 'employee'))->count(21)->create();
  }
}
