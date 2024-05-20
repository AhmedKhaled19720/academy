<?php

use App\Model\Userlogin; 
use Illuminate\Database\Seeder;

class UserloginSeeder extends Seeder
{
    
    public function run()
    {
        Userlogin::create([
            'username' => 'john_doe',
            'email' => 'john@example.com',
            'phone' => '1234567890',
            'city' => 'New York',
            'password' => bcrypt('password'),
            'role' => 'active',
            'created_by' => null,
        ]);

        Userlogin::create([
            'username' => 'jane_smith',
            'email' => 'jane@example.com',
            'phone' => '0987654321',
            'city' => 'Los Angeles',
            'password' => bcrypt('password'),
            'role' => 'disactive',
            'created_by' => null,
        ]);

        Userlogin::create([
            'username' => 'alice_jones',
            'email' => 'alice@example.com',
            'phone' => '1231231234',
            'city' => 'Chicago',
            'password' => bcrypt('password'),
            'role' => 'active',
            'created_by' => 'john_doe',
        ]);
    }
}