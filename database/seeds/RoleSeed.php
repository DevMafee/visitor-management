<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     //'administrator','employee_manage','visitor_manage'
     */
    public function run()
    {
        $role = Role::create(['name' => 'administrator']);
        $role->givePermissionTo('users_manage');
        $role->givePermissionTo('employee_manage');
        $role->givePermissionTo('visitor_manage');

        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo('employee_manage');
        $role->givePermissionTo('visitor_manage');

        $role = Role::create(['name' => 'receptionist']);
        $role->givePermissionTo('visitor_manage');
    }
}
