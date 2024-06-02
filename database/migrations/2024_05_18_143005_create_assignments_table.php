<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assignments', function (Blueprint $table) {
            $table->id();
            $table->string('ass_title');
            $table->text('ass_description')->nullable;
            $table->string('ass_file')->nullable();
            $table->date('deadline');
            $table->foreignId('course_id')->constrained('courses')->onDelete('cascade');
            $table->text('notes')->nullable();
            $table->integer('degree')->default('0');
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
        Schema::dropIfExists('assignments');
    }
}