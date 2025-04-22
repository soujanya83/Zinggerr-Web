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
            $table->integer('position')->default(0);
            $table->timestamps();
        });


        // Insert default data
        DB::table('montessori_age_groups')->insert([
            [
                'id' => (string) Str::uuid(),
                'full_name' => 'Montessori (0-3)',
                'short_name' => 'Montessori',
                'position'=>1,
                'slug' => Str::slug('Montessori (0-3)'),
                'description' => 'This program caters to children from birth to 3 years, sometimes with separate infant (birth-18 months) and toddler (18 months-3 years) classrooms.',
                'status' => 1
            ],
            [
                'id' => (string) Str::uuid(),
                'full_name' => 'Casa Dei Bambini (3-6 Years)',
                'short_name' => 'Casa Dei Bambini',
                'position'=>2,
                'slug' => Str::slug('Casa Dei Bambini (3-6 Years)'),
                'description' => 'This is a common starting point for Montessori education, typically encompassing children aged 3-6 years, where children learn together in a mixed-age setting.',
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
