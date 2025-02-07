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
        Schema::create('video_quizzes', function (Blueprint $table) {
            $table->char('id', 36)->primary();
            $table->string('course_id')->nullable()->default(null);
            $table->string('chapter_id')->nullable()->default(null);
            $table->string('video_name');
            $table->integer('quiz_time'); // Time in seconds when quiz appears
            $table->text('quiz_question');
            $table->string('option_1');
            $table->string('option_2');
            $table->string('option_3');
            $table->string('option_4');
            $table->integer('correct_option');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('videos_quiz');
    }
};
