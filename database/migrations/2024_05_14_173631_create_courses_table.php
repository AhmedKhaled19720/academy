<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('course_title');
            $table->string('course_description');
            $table->string('course_img')->nullable();
            $table->integer('lecture_no');
            $table->integer('hours_no');
            $table->double('price');
            $table->date('start_date');
            $table->integer('duration');
            $table->enum('level', ['beginner', 'intermediate', 'advanced'])->default('beginner');
            $table->enum('status', ['active', 'disactive', 'archived'])->default('active');
            $table->foreignId('category_id')->constrained('categories','id')->cascadeOnDelete();
            $table->foreignId('instructor_id')->constrained('instructors','id')->cascadeOnDelete();
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
        Schema::dropIfExists('courses');
    }
}