<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('title_banner_1');
            $table->string('title_banner_2');
            $table->string('title_banner_3');
            $table->string('caption_banner');
            $table->string('instructor_title');
            $table->string('instructor_caption');
            $table->string('instructor_become_title');
            $table->string('instructor_become_caption');
            $table->string('discount_title_1');
            $table->string('discount_title_2');
            $table->string('discount_caption');
            $table->string('discount_img');
            $table->string('discount_percent');
            $table->string('footer_address');
            $table->string('footer_mail');
            $table->string('footer_phone_1');
            $table->string('footer_phone_2');
            $table->string('footer_facebook');
            $table->string('footer_twitter');
            $table->string('footer_instagram');
            $table->string('footer_linkedin');
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
        Schema::dropIfExists('settings');
    }
}
