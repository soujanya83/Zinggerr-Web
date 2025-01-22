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
            $table->string('assets_type');
            $table->string('topic_name');
            $table->string('course_id');
            $table->string('chapter_id');
            $table->text('blog_description')->nullable()->default(null);
            $table->string('images')->nullable()->default(null);
            $table->string('assets_video')->nullable()->default(null);
            $table->string('video_url')->nullable()->default(null);
            $table->string('youtube_links')->nullable()->default(null);
            $table->boolean('status')->default(1);



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
