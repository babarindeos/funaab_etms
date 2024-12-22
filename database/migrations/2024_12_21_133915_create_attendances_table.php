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
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('academic_session_id');
            $table->unsignedBigInteger('semester_id');
            $table->unsignedBigInteger('exam_id');
            $table->unsignedBigInteger('exam_day_id');
            $table->unsignedBigInteger('invigilator_id');
            $table->unsignedBigInteger('invigilator_allocation_id')->unique();
            $table->unsignedBigInteger('supervisor_allocation_id');
            $table->unsignedBigInteger('venue_id');
            $table->unsignedBigInteger('time_period_id');
            $table->unsignedBigInteger('supervisor_id');
           
            $table->string('attendance');
            $table->decimal('attendance_amount', 10,2);
            $table->decimal('attendance_point');
           

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

            $table->foreign('invigilator_id')
            ->references('id')
            ->on('users')
            ->onDelete('cascade');

            $table->foreign('invigilator_allocation_id')
            ->references('id')
            ->on('invigilator_allocations')
            ->onDelete('cascade');

            $table->foreign('supervisor_allocation_id')
            ->references('id')
            ->on('timtec_allocations')
            ->onDelete('cascade');

            $table->timestamps();
        });

        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
