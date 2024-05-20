<?php

use App\Model\category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name' => 'Programming',
            'cate_image' => 'programming.jpg',
            'title' => 'Programming Courses',
            'description' => 'Courses related to programming languages and technologies.',
        ]);

        Category::create([
            'name' => 'Web Development',
            'cate_image' => 'web_development.jpg',
            'title' => 'Web Development Courses',
            'description' => 'Courses related to building websites and web applications.',
        ]);

        Category::create([
            'name' => 'Data Science',
            'cate_image' => 'data_science.jpg',
            'title' => 'Data Science Courses',
            'description' => 'Courses related to data analysis, machine learning, and data visualization.',
        ]);
    }
}
