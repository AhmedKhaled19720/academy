<?php

use Illuminate\Database\Seeder;
use App\Model\course;


class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
    
      course::create([
        'id'=>1,
        'course_title' => 'Introduction to Programming',
        'course_description' => 'This course covers the basics of programming.',
        'lecture_no' => 10,
        'hours_no' => 20,
        'price' => 99.99,
        'start_date' => '2024-06-01',
        'duration' => 4,
        'level' => 'beginner',
        'status' => 'active',
        'category_id' => 2,
        'instructor_id' => 2,
        'course_img'=>null,

      ]);
      course::create([
        'id'=>2,
        'course_title' => 'Introduction to web',
        'course_description' => 'This course covers the basics of web.',
        'lecture_no' => 10,
        'hours_no' => 20,
        'price' => 99.99,
        'start_date' => '2024-07-01',
        'duration' => 6,
        'level' => 'beginner',
        'status' => 'active',
        'category_id' => 1,
        'instructor_id' => 1,
        'course_img'=>null,

      ]);
    }
}
