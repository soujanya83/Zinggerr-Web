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
        Schema::create('courses_chapters', function (Blueprint $table) {

            $table->char('id', 36)->primary();
            $table->string('courses_id');
            $table->string('chepter_name');
            $table->string('chepter_discription')->nullable()->default(null);
            $table->integer('no_of_chepter')->nullable()->default(null);
            $table->integer('status');
            $table->integer('mode')->nullable()->default(null);

            $table->timestamps();
            $table->foreign('courses_id')->references('id')->on('courses')->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses_chapters');
    }
};
