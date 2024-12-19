<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            'id' => Str::uuid(),
            'name' => 'superadmin',
            'display_name' => 'Super Admin',
            'description' => 'Super Administrator',
        ]);

        Role::create([
            'id' => Str::uuid(),
            'name' => 'admin',
            'display_name' => 'Admin',
            'description' => 'Administrator'
        ]);

        Role::create([
            'id' => Str::uuid(),
            'name' => 'student',
            'display_name' => 'Student',
            'description' => 'Student'
        ]);

        Role::create([
            'id' => Str::uuid(),
            'name' => 'teacher',
            'display_name' => 'Teacher',
            'description' => 'Teacher'
        ]);

        Role::create([
            'id' => Str::uuid(),
            'name' => 'staff',
            'display_name' => 'Staff',
            'description' => 'Staff'
        ]);
    }
}
