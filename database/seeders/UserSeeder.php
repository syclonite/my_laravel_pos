<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'id'=> 4,
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin1234'),
            'phone'=>'01716994848',
            'address' => 'N/A',
            'status' => '1',
            'role_id' => '4',
        ]);

        User::create([
                'id'=> 5,
                'name' => 'Employee',
                'email' => 'employee@gmail.com',
                'password' => bcrypt('admin1234'),
                'phone'=>'01711280681',
                'address' => 'N/A',
                'status' => '1',
                'role_id' => '5'
            ]);
    }
}
