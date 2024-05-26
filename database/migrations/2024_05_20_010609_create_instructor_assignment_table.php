<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstructorAssignmentTable extends Migration
{
    public function up()
    {
        Schema::create('instructor_assignment', function (Blueprint $table) {
            $table->id();
           
            $table->timestamps();

            $table->foreignId('instructor_id')->constrained('instructors','id')->onDelete('cascade');
            $table->foreignId('assignment_id')->constrained('assignments','id')->onDelete('cascade');

            
        });
    }

    public function down()
    {
        Schema::dropIfExists('instructor_assignment');
    }
}

