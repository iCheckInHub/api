<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

    Role::create(['name' => 'admin', 'guard_name' => 'admin']);

    Role::create(['name' => 'customer', 'guard_name' => 'customer']);

    Role::create(['name' => 'owner', 'guard_name' => 'employee']);
    Role::create(['name' => 'employee', 'guard_name' => 'employee']);
  }
}
