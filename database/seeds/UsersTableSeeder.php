<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superAdmin = Role::where('name', 'Super Admin')->first()->id;

        User::create([

        	'name' => 'Super Admin',
        	'email' => 'super_admin@gmail.com',
        	'password' => bcrypt('super_admin'),
        	'role_id' => $superAdmin

        ]);
    }
}
