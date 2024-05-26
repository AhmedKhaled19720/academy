<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstructorRequestsTable extends Migration
{
    public function up()
    {
        Schema::create('instructor_requests', function (Blueprint $table) {
            $table->id()->nullable();
            $table->string('name');
            $table->string('job');
            $table->string('cv');
            $table->string('email');
            $table->string('phone');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('instructor_requests');
    }
}
