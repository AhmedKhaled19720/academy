<?php

use Illuminate\Database\Seeder;
use App\Model\instructor;

class InstructorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        instructor::insert([
            [
                'name' => 'John Doe',
                'job' => 'Software Engineer',
                'email' => 'john@example.com',
                'password' => bcrypt('password'),
                'instructor_img' => 'john_doe.jpg',
                'description' => 'An experienced software engineer.',
            
            ],
            [
                'name' => 'Jane Smith',
                'job' => 'Web Developer',
                'email' => 'jane@example.com',
                'password' => bcrypt('password'),
                'instructor_img' => 'jane_smith.jpg',
                'description' => 'A skilled web developer.',
               
            ]
        ]);
    }
}
