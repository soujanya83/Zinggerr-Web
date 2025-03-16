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
        Schema::create('montessori_age_groups', function (Blueprint $table) {
            $table->char('id', 36)->primary();
            $table->string('full_name');
            $table->string('short_name');
            $table->char('montessori_areas_id', 36)->nullable()->default(null);
            $table->string('slug');
            $table->char('created_by', 36)->nullable();
            $table->char('updated_by', 36)->nullable();
            $table->text('description');
            $table->integer('status')->default(1);
            $table->timestamps();
        });


        // Insert default data
        DB::table('montessori_age_groups')->insert([
            [
                'id' => (string) Str::uuid(),
                'full_name' => 'Toddlers (0-3 years)',
                'short_name' => 'Toddlers',
                'slug' => Str::slug('Toddlers (0-3 years)'),
                'description' => 'This program caters to children from birth to 3 years, sometimes with separate infant (birth-18 months) and toddler (18 months-3 years) classrooms.',
                'status' => 1
            ],
            [
                'id' => (string) Str::uuid(),
                'full_name' => 'Early Childhood (3-6 years)',
                'short_name' => 'Early Childhood',
                'slug' => Str::slug('Early Childhood (3-6 years)'),
                'description' => 'This is a common starting point for Montessori education, typically encompassing children aged 3-6 years, where children learn together in a mixed-age setting.',
                'status' => 1
            ],
            [
                'id' => (string) Str::uuid(),
                'full_name' => 'Elementarys (6-12 years)',
                'short_name' => 'Elementarys',
                'slug' => Str::slug('Elementary (6-12 years)'),
                'description' => 'This program is for children aged 6 to 12 years, and some schools further divide it into Lower Elementary (6 to 9 years) and Upper Elementary (9-12 years).',
                'status' => 1
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_mentessori_age_groups');
    }
};
