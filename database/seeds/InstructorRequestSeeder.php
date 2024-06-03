<?php

use App\Model\InstructorRequest;
use Illuminate\Database\Seeder;

class InstructorRequestSeeder extends Seeder
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

            InstructorRequest::create([
                'name' => 'John Doe',
                'job' => 'Instructor',
                'cv' => 'path/to/cv.pdf',
                'email' => 'john@example.com',
                'phone' => '123456789',
                'role' => $role,
            ]);
        }
    }
}