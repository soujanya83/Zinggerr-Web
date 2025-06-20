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
        Schema::create('task_assign_users', function (Blueprint $table) {
            $table->char('id', 36)->primary();
            $table->char('task_id', 36);
            $table->char('user_id', 36)->nullable()->default(null);
            $table->char('role_id', 36)->nullable()->default(null);
            $table->char('course_id', 36)->nullable()->default(null);
            $table->date('task_completed_date')->nullable();
            $table->char('updated_by', 36)->nullable();
            $table->char('created_by', 36)->nullable();
            $table->timestamps();

            $table->foreign('task_id')->references('id')->on('task')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('task_assign_users');
    }
};
