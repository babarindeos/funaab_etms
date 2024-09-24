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
        Schema::create('announcements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cell_id');
            $table->foreign('cell_id')->references('id')->on('cells')->onDelete('cascade');
            $table->string('subject');
            $table->text('message');
            $table->string('link')->nullable();
            $table->string('file')->nullable();
            $table->string('filesize')->nullable();
            $table->string('filetype')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('announcements');
    }
};
