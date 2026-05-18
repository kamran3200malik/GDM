<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get role IDs
        $superAdminRole = Role::where('name', 'superadmin')->first();
        $adminRole = Role::where('name', 'admin')->first();
        $teacherRole = Role::where('name', 'teacher')->first();

        // Create Super Admin
        User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@school.com',
            'service_number' => '4306',
            'password' => Hash::make('11223344'),
            'role_id' => $superAdminRole->id,
        ]);

        // Create Admin
        User::create([
            'name' => 'School Admin',
            'email' => 'admin@school.com',
            'service_number' => '4309',
            'password' => Hash::make('11223344'),
            'role_id' => $adminRole->id,
        ]);

        // Create Teacher
        User::create([
            'name' => 'John Teacher',
            'email' => 'teacher@school.com',
            'service_number' => '4310',
            'password' => Hash::make('password'),
            'role_id' => $teacherRole->id,
        ]);
    }
}
