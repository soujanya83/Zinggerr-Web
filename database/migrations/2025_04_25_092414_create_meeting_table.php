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
        Schema::create('meetings', function (Blueprint $table) {
            $table->char('id', 36)->primary();
            $table->string('meeting_id')->unique(); // BigBlueButton meeting ID
            $table->string('meeting_name');
            $table->string('moderator_pw');
            $table->string('attendee_pw');
            $table->text('moderator_join_url');
            $table->text('attendee_join_url');
            $table->char('host_started')->default(false);
            $table->timestamp('scheduled_at')->nullable(); // Scheduled time
            $table->enum('status', ['scheduled', 'running', 'ended'])->default('scheduled');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meeting');
    }
};
