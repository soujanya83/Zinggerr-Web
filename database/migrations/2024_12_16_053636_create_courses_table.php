<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->char('id', 36)->primary();
            $table->string('course_full_name', 255);
            $table->string('course_short_name', 255);
            $table->string('course_category', 100);
            $table->date('course_start_date');
            $table->date('course_end_date');
            $table->string('course_id_number', 50)->nullable();
            $table->boolean('course_status')->default(1);
            $table->boolean('downloa_status')->default(0);
            $table->text('course_summary');
            $table->string('course_image', 255)->nullable();
            $table->string('hidden_section', 255)->nullable();
            $table->string('course_layout', 255)->nullable();
            $table->integer('course_sections')->default(0);
            $table->string('force_theme', 50)->nullable();
            $table->string('force_language', 50)->nullable();
            $table->unsignedTinyInteger('no_announcements')->default(0);
            $table->boolean('gradebook_student')->default(0);
            $table->boolean('activity_report')->default(0);
            $table->boolean('activity_date')->default(0);
            $table->char('file_uploads_size',50)->default(0);
            $table->boolean('completion_tracking')->default(0);
            $table->boolean('activity_completion_conditions')->default(0);
            $table->string('group_mode', 50)->nullable();
            $table->boolean('force_group_mode')->default(0);
            $table->string('default_group', 50)->nullable();
            $table->string('course_format', 100)->nullable();
            $table->string('tags', 50)->nullable();
            $table->integer('module_credit')->default(0);
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
