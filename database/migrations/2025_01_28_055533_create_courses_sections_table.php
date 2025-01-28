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
        Schema::create('courses_sections', function (Blueprint $table) {
            $table->char('id', 36)->primary();
            $table->string('courses_id');
            $table->string('course_start_date');
            $table->string('sections_remark_date')->nullable();;
            $table->text('sections_remark')->nullable();
            $table->boolean('status')->nullable()->default(1);
            $table->timestamps();

            $table->foreign('courses_id')->references('id')->on('courses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses_sections');
    }
};
