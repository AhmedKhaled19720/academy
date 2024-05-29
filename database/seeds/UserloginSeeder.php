<?php

use App\Model\Userlogin;
use Illuminate\Database\Seeder;

class UserloginSeeder extends Seeder
{

    public function run()
    { {
            for ($i = 1; $i <= 10; $i++) {
                Userlogin::create([
                    'username' => 'user_' . $i,
                    'email' => 'user_' . $i . '@example.com',
                    'password' => bcrypt('password123'),
                    'phone' => '123456789',
                    'city' => 'City_' . $i,
                    'role' => $i % 2 == 0 ? 'active' : 'disactive',
                    'created_by' => 1,
                ]);
            }
        }
    }
}
