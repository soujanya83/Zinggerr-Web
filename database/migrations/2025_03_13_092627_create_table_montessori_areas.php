<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('montessori_areas', function (Blueprint $table) {
            $table->char('id', 36)->primary();
            $table->string('full_name');
            $table->string('short_name');
            $table->string('slug');
            $table->char('created_by', 36)->nullable();
            $table->char('updated_by', 36)->nullable();
            $table->text('description');
            $table->integer('status')->default(1);

            $table->timestamps();
        });

        // Insert default data
        DB::table('montessori_areas')->insert([
            [
                'id' => (string) Str::uuid(),
                'full_name' => 'Practical Life',
                'short_name' => 'PL',
                'slug' => Str::slug('Practical Life'),
                'description' => 'This area focuses on developing everyday skills like dressing, pouring liquids, setting the table, and cleaning up, fostering independence and self-sufficiency.',
                'status' => 1
            ],
            [
                'id' => (string) Str::uuid(),
                'full_name' => 'Sensorial',
                'short_name' => 'SEN',
                'slug' => Str::slug('Sensorial'),
                'description' => 'This area uses materials designed to refine the senses (sight, touch, sound, taste, smell) and enhance a child’s ability to learn through sensory experiences.',
                'status' => 1
            ],
            [
                'id' => (string) Str::uuid(),
                'full_name' => 'Mathematics',
                'short_name' => 'MATH',
                'slug' => Str::slug('Mathematics'),
                'description' => 'Montessori mathematics materials help children develop an understanding of numbers and mathematical concepts through concrete materials and hands-on activities.',
                'status' => 1
            ],
            [
                'id' => (string) Str::uuid(),
                'full_name' => 'Language',
                'short_name' => 'LANG',
                'slug' => Str::slug('Language'),
                'description' => 'The language area emphasizes listening, speaking, reading, and writing, providing a holistic approach to language development.',
                'status' => 1
            ],
            [
                'id' => (string) Str::uuid(),
                'full_name' => 'Cultural Studies',
                'short_name' => 'CULT',
                'slug' => Str::slug('Cultural Studies'),
                'description' => 'This area introduces children to geography, history, science, art, and music, fostering an understanding of the world and different cultures.',
                'status' => 1
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_mentessori_areas');
    }
};
