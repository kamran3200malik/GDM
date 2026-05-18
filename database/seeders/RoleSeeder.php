<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => 'superadmin',
                'display_name' => 'Super Admin',
                'description' => 'Full system access with all privileges',
                'color' => '#DC2626', // Red
                'is_active' => true,
            ],
            [
                'name' => 'admin',
                'display_name' => 'Administrator',
                'description' => 'School management with administrative privileges',
                'color' => '#2563EB', // Blue
                'is_active' => true,
            ],
            [
                'name' => 'teacher',
                'display_name' => 'Teacher',
                'description' => 'Classroom management and teaching tools',
                'color' => '#16A34A', // Green
                'is_active' => true,
            ],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
