<?php

use Illuminate\Database\Seeder;
use App\Models\Role;
class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_admin              = new Role();
        $role_admin->name        = 'admin';
        $role_admin->description = 'administrator eredivisie voetbal league';
        $role_admin->save();

        $role_manager              = new Role();
        $role_manager->name        = 'manager';
        $role_manager->description = 'Eredivisie voetbal league managers';
        $role_manager->save();
    }
}
