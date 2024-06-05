<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnrollcoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enrollcourses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained('courses', 'id')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('userlogins', 'id')->cascadeOnDelete();
            $table->dateTime('registration_date')->nullable();
            $table->enum('subscription_status', ['active', 'inactive'])->default('active');
            $table->unsignedTinyInteger('rating')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('enrollcourses');
    }
}