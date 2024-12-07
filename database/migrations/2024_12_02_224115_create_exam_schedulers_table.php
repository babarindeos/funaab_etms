<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('exam_schedulers', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('academic_session_id');
                $table->unsignedBigInteger('semester_id');
                $table->unsignedBigInteger('exam_id');
                $table->unsignedBigInteger('exam_day_id');
                $table->unsignedBigInteger('course_id');
                $table->unsignedBigInteger('venue_id');
                $table->unsignedBigInteger('time_period_id');
                $table->unsignedBigInteger('user_id');

                $table->foreign('academic_session_id')
                    ->references('id')
                    ->on('academic_sessions')
                    ->onDelete('cascade');

                $table->foreign('semester_id')
                    ->references('id')
                    ->on('semesters')
                    ->onDelete('cascade');

                $table->foreign('exam_id')
                    ->references('id')
                    ->on('exams')
                    ->onDelete('cascade');


                $table->foreign('exam_day_id')
                    ->references('id')
                    ->on('exam_days')
                    ->onDelete('cascade');

                $table->foreign('course_id')
                    ->references('id')
                    ->on('courses')
                    ->onDelete('cascade');

                $table->foreign('venue_id')
                    ->references('id')
                    ->on('venues')
                    ->onDelete('cascade');

                $table->foreign('time_period_id')
                    ->references('id')
                    ->on('exam_time_periods')
                    ->onDelete('cascade');

                $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');

                $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam_schedulers');
    }
};
