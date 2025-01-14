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
        Schema::create('courses_assets', function (Blueprint $table) {
            $table->char('id', 36)->primary();
            $table->string('blog_name');
            $table->string('course_id');
            $table->string('chapter_id');

            $table->integer('blogstatus')->default(1);
            $table->string('no_of_blog')->nullable();
            $table->string('topic_image')->nullable();
            $table->string('topic_name')->nullable();
            $table->string('video_links')->nullable();
            $table->string('assets_discription');
            $table->string('course_assets_video')->nullable();
            $table->timestamps();

            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->foreign('chapter_id')->references('id')->on('courses_chepters')->onDelete('cascade');

            $table->index('course_id');
            $table->index('chapter_id');
        });



    }


    public function down(): void
    {
        Schema::dropIfExists('assets');
    }
};
