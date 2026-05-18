<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::where('name', 'admin')->first();
        
        User::updateOrCreate(
            ['email' => 'admin@school.com'],
            [
                'name' => 'Admin',
                'service_number' => '4309',
                'password' => Hash::make('11223344'),
                'role_id' => $adminRole->id,
            ]
        );
    }
}
