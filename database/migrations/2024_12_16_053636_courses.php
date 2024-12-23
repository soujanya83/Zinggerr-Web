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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('course_name', 255);
            $table->string('code', 255);
            $table->string('start_date', 20);
            $table->string('duration', 255);
            $table->integer('price');
            $table->string('teacher_name', 255);
            $table->integer('max_students');
            $table->tinyInteger('status')->default(0);
            $table->text('details');
            $table->text('course_image');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
