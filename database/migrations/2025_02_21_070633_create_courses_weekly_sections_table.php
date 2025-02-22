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
        Schema::create('courses_weekly_sections', function (Blueprint $table) {
            $table->char('id', 36)->primary();
            $table->char('course_id', 36);
            $table->string('date', 36);
            $table->string('assetstype', 36);
            $table->text('blog')->nullable()->default(null);;
            $table->text('url')->nullable()->default(null);;
            $table->text('youtube')->nullable()->default(null);;
            $table->text('video')->nullable()->default(null);;
            $table->integer('status');

            $table->timestamps();

            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses_weekly_sections');
    }
};
