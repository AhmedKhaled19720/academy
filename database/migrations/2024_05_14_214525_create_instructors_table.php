<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstructorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instructors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('password')->default('123');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('description');
            $table->string('job');
            $table->string('instructor_img');
            $table->string('instructor_facebook')->nullable();
            $table->string('instructor_linkedin')->nullable();
            $table->string('instructor_insta')->nullable();
            $table->string('instructor_twitter')->nullable();
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
        Schema::dropIfExists('instructors');
    }
}
