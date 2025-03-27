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
        Schema::create('events', function (Blueprint $table) {
            $table->char('id', 36)->primary();
            $table->text('event_topic');
            $table->text('description');
            $table->date('event_start_date')->nullable();
            $table->date('event_end_date')->nullable();
            $table->time('event_start_time')->nullable()->default('00:00:00');
            $table->time('event_end_time')->nullable()->default('23:59:59');;
            $table->boolean('status')->default(1);
            $table->char('created_by',36)->nullable();
            $table->char('updated_by',36)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event');
    }
};
