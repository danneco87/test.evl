<?php

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new Role();
        $role_admin       = $role->where('name', 'admin')->first();
        $role_manager     = $role->where('name', 'manager')->first();
        $admin            = new User();
        $admin->firstname = 'Danne';
        $admin->lastname  = 'Connolly';
        $admin->email     = 'danneconnolly@gmail.com';
        $admin->password  = bcrypt('evl@1987');
        $admin->save();

        $admin->roles()->attach($role_admin);
        $admin->roles()->attach($role_manager);

        $manager       = new User();
        $manager->firstname = 'Arjen';
        $manager->lastname = 'Versteeg';
        $manager->email = 'danne@vipresponse.nl';
        $manager->password = bcrypt('evl@1987');
        $manager->save();

        $manager->roles()->attach($role_manager);
    }
}
