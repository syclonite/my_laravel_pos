<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'id'=> 1,
            'role_name' => 'admin',
            'role_description' => 'Admin Role',
            'status' => '1',
        ]);
        Role::create([
            'id'=> 2,
            'role_name' => 'employee',
            'role_description' => 'Employee Role',
            'status' => '1',
        ]);
    }
}
