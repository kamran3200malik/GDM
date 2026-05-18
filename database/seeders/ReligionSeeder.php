<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Religion;

class ReligionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $religions = [
            ['name' => 'Islam', 'is_active' => true],
            ['name' => 'Christianity', 'is_active' => true],
            ['name' => 'Hinduism', 'is_active' => true],
            ['name' => 'Sikhism', 'is_active' => true],
            ['name' => 'Buddhism', 'is_active' => true],
            ['name' => 'Judaism', 'is_active' => true],
            ['name' => 'Parsi/Zoroastrianism', 'is_active' => true],
            ['name' => 'Baháʼí', 'is_active' => true],
            ['name' => 'Jainism', 'is_active' => true],
            ['name' => 'Other', 'is_active' => true],
            ['name' => 'None/Atheist', 'is_active' => true],
        ];

        foreach ($religions as $religion) {
            Religion::create($religion);
        }
    }
}
