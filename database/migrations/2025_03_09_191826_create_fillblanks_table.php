<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('fillblanks', function (Blueprint $table) {
            $table->char('id', 36)->primary();
            $table->unsignedBigInteger('course_id');
            $table->unsignedBigInteger('chapter_id');
            $table->string('video_name');
            $table->integer('video_time');
            $table->text('instructions');
            $table->text('sentence');
            $table->text('answers');
            $table->boolean('skippable')->default(false);
            $table->float('position_x')->nullable();
            $table->float('position_y')->nullable();
            $table->timestamps();
            
            // Add foreign key constraints if needed
            // $table->foreign('course_id')->references('id')->on('courses');
            // $table->foreign('chapter_id')->references('id')->on('chapters');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fillblanks');
    }
};
