<?php

use App\Model\contactUs;
use Illuminate\Database\Seeder;

class ContactUsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 10; $i++) {
            $role = $i % 2;

            contactUs::create([
                'full_name' => 'John Doe',
                'email' => 'john@example.com',
                'phone' => '123456789',
                'message' => 'Hello, this is a test message.',
                'role' => $role,
            ]);
        }
    }
}