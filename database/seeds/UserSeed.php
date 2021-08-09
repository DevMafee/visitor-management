<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Super Admin',
            'designation' => 'Super Admin',
            'email' => 'superadmin@gmail.com',
            'password' => bcrypt('simecdev123')
        ]);
        $user->assignRole('administrator','admin','receptionist');

        $user = User::create([
            'name' => 'Admin',
            'designation' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123456')
        ]);
        $user->assignRole('admin','receptionist');

        $user = User::create([
            'name' => 'Receptionist',
            'designation' => 'Receptionist',
            'email' => 'receptionist@gmail.com',
            'password' => bcrypt('123456')
        ]);
        $user->assignRole('receptionist');

        $user = User::create([
            'name' => 'Md Khairul Alam',
            'designation' => 'Senior Security Assistant',
            'email' => '100',
            'password' => bcrypt('123456')
        ]);
        $user->assignRole('receptionist');

        $user = User::create([
            'name' => 'Nafiza Yeasmin',
            'designation' => 'SG',
            'email' => '101',
            'password' => bcrypt('123456')
        ]);
        $user->assignRole('receptionist');

        $user = User::create([
            'name' => 'Anarkoli Akhter',
            'designation' => 'SG',
            'email' => '102',
            'password' => bcrypt('123456')
        ]);
        $user->assignRole('receptionist');

    }
}
