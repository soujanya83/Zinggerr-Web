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
            $table->string('background_color',36);
            $table->string('text_color',36);
            $table->datetime('event_start')->nullable(); // Merged date and time
            $table->datetime('event_end')->nullable();   // Merged date and time
            $table->boolean('status')->default(1);
            $table->char('created_by', 36)->nullable();
            $table->char('updated_by', 36)->nullable();

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
