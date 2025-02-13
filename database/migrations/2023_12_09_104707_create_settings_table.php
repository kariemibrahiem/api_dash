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
            $table->text('logo');
            $table->text('favicon');
            $table->string('title_ar');
            $table->string('title_en');
            $table->text('footer_ar');
            $table->text('footer_en');
            $table->text('facebook');
            $table->text('twitter');
            $table->text('google');
            $table->text('youtube');
            $table->text('instagram');
            $table->text('location_ar');
            $table->text('location_en');
            $table->text('location_url');
            $table->string('email');
            $table->string('phone');
            $table->string('working_hours');
            $table->string('terms');
            $table->string('privacy');
            $table->string('faqs');
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
