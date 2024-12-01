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
        Schema::create('venues', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('venue_type_id');
            $table->foreign('venue_type_id')->references('id')->on('venue_types')->onDelete('cascade');
            $table->unsignedBigInteger('venue_category_id');
            $table->foreign('venue_category_id')->references('id')->on('venue_categories')->onDelete('cascade');
            $table->integer('student_capacity');
            $table->integer('max_invigilators');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('venues');
    }
};
