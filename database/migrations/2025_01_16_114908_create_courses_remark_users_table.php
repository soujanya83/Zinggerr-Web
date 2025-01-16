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
        Schema::create('courses_remarks', function (Blueprint $table) {
            $table->char('id', 36)->primary();
            $table->string('courses_id');
            $table->string('users_id');
            $table->text('remarks');
            $table->timestamps();

            $table->foreign('courses_id')->references('id')->on('courses')->onDelete('cascade');
            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses_remark_users');
    }
};
