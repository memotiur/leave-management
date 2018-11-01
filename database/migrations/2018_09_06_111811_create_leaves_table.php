<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeavesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leaves', function (Blueprint $table) {
            $table->increments('leave_id');
            $table->unsignedInteger('user_id');
            $table->string('applicant_leave_from');
            $table->string('applicant_leave_to');
            $table->integer('applicant_leave_duration');
            $table->text('applicant_leave_reason');
            $table->text('applicant_leave_type')->nullable();
            $table->integer('applicant_available_holidays')->nullable();
            $table->string('applicant_attachment1')->nullable();
            $table->string('applicant_attachment2')->nullable();

            $table->string('applicant_taken_leave_from')->nullable();
            $table->string('applicant_taken_leave_to')->nullable();
            $table->integer('applicant_taken_leave_duration')->nullable();
            $table->string('applicant_leave_time_location');
            $table->string('applicant_leave_time_phone')->nullable();
            $table->unsignedInteger('replacement_person_id')->nullable();
            $table->integer('replacement_person_agreement')->default(0);
            $table->string('recommend_officer_comment')->nullable();
            $table->integer('recommend_officers_decision')->default(0);
            $table->integer('grant_officers_decision')->default(0);
            $table->text('comment')->nullable();
            $table->timestamps();
            $table->foreign('replacement_person_id')->references('id')->on('users');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('leaves');
    }
}
