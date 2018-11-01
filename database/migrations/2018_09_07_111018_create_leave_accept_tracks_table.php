<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeaveAcceptTracksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leave_accept_tracks', function (Blueprint $table) {
            $table->increments('track_id');
            $table->unsignedInteger('leave_id')->unique();
            $table->unsignedInteger('recommend_officer_id')->nullable();
            $table->unsignedInteger('grant_officer_id')->nullable();
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
        Schema::dropIfExists('leave_accept_tracks');
    }
}
