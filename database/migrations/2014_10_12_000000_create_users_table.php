<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('username');
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('dateofjoining')->nullable();
            $table->string('dateofbirth')->nullable();
            $table->string('designation')->nullable();
            $table->string('profile_pic')->nullable();
            $table->integer('usertype');
            $table->string('password');
            $table->unsignedInteger('authority_id');
            $table->integer('active_status')->default(1); //0 Pending, 1 Active, 2 Deactive
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
