<?php

use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [

        	'admin',
        	'supervisor',
        	'writer',
        	'user'

        ];



        foreach ($roles as $role) {
        	
        	Role::create([

        		'name' => $role,

        	]);

        }
    }
}
