<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Province;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $provinces = [
            [
                'name' => 'Punjab',
                'code' => 'PB',
                'is_active' => true,
            ],
            [
                'name' => 'Sindh',
                'code' => 'SD',
                'is_active' => true,
            ],
            [
                'name' => 'Khyber Pakhtunkhwa',
                'code' => 'KP',
                'is_active' => true,
            ],
            [
                'name' => 'Balochistan',
                'code' => 'BA',
                'is_active' => true,
            ],
            [
                'name' => 'Islamabad Capital Territory',
                'code' => 'ICT',
                'is_active' => true,
            ],
            [
                'name' => 'Azad Kashmir',
                'code' => 'AJK',
                'is_active' => true,
            ],
            [
                'name' => 'Gilgit-Baltistan',
                'code' => 'GB',
                'is_active' => true,
            ],
        ];

        foreach ($provinces as $province) {
            Province::create($province);
        }
    }
}
