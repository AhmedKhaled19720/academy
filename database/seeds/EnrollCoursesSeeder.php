<?php

use App\Model\enrollcourse;
use App\Model\Userlogin;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;


class EnrollCoursesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = Userlogin::all();

        if ($users->isNotEmpty()) {
            foreach ($users as $user) {
                enrollcourse::updateOrCreate(
                    ['user_id' => $user->id],
                    [
                        'course_id' => rand(1, 2),
                        'registration_date' => now(),
                        'subscription_status' => 'active',
                    ]
                );
            }
        } else {
            $this->command->error('No users found. Please add users before running this seeder.');
        }
    }
}
