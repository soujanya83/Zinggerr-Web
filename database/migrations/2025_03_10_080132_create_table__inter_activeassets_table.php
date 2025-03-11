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
        Schema::create('interactive_assets', function (Blueprint $table) {
            $table->char('id', 36)->primary();
            $table->string('user_id');
            $table->string('video_id');
            $table->unsignedBigInteger('asset_id');
            $table->decimal('checkpoint_time', 8, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table__inter_activeassets');
    }
};
