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

        	['admin', 'Admin'],
        	['supervisor', 'Supervisor'],
        	['writer', 'Writer'],
        	['user', 'Norma User']

        ];

        foreach ($roles as $role) {
        	
        	Role::create([

        		'name' => $role[0],
                'display_name' => $role[1]

        	]);

        }
    }
}
