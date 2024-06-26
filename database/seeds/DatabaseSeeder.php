<?php

use App\Model\contactUs;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CategorySeeder::class,
            InstructorSeeder::class,
            CourseSeeder::class,
            UserloginSeeder::class,
            ContactUsSeeder::class,
            InstructorRequestSeeder::class,

        ]);
    }
}
