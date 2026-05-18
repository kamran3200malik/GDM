<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tehseel;
use App\Models\District;

class TehseelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get districts
        $lahore = District::where('code', 'LHR')->first();
        $karachi = District::where('code', 'KHI')->first();
        $peshawar = District::where('code', 'PSW')->first();
        $quetta = District::where('code', 'QTA')->first();
        $islamabad = District::where('code', 'ISB')->first();
        $faisalabad = District::where('code', 'FSD')->first();
        $multan = District::where('code', 'MUL')->first();
        $rawalpindi = District::where('code', 'RWP')->first();

        $tehseels = [
            // Lahore District Tehseels
            ['district_id' => $lahore->id, 'name' => 'Lahore City', 'code' => 'LHR-CITY', 'is_active' => true],
            ['district_id' => $lahore->id, 'name' => 'Lahore Cantonment', 'code' => 'LHR-CANT', 'is_active' => true],
            ['district_id' => $lahore->id, 'name' => 'Model Town', 'code' => 'LHR-MT', 'is_active' => true],
            ['district_id' => $lahore->id, 'name' => 'Gulberg', 'code' => 'LHR-GB', 'is_active' => true],
            ['district_id' => $lahore->id, 'name' => 'Shalimar', 'code' => 'LHR-SH', 'is_active' => true],

            // Karachi District Tehseels
            ['district_id' => $karachi->id, 'name' => 'Karachi East', 'code' => 'KHI-E', 'is_active' => true],
            ['district_id' => $karachi->id, 'name' => 'Karachi West', 'code' => 'KHI-W', 'is_active' => true],
            ['district_id' => $karachi->id, 'name' => 'Karachi South', 'code' => 'KHI-S', 'is_active' => true],
            ['district_id' => $karachi->id, 'name' => 'Karachi Central', 'code' => 'KHI-C', 'is_active' => true],
            ['district_id' => $karachi->id, 'name' => 'Malir', 'code' => 'KHI-ML', 'is_active' => true],
            ['district_id' => $karachi->id, 'name' => 'Korangi', 'code' => 'KHI-KR', 'is_active' => true],

            // Peshawar District Tehseels
            ['district_id' => $peshawar->id, 'name' => 'Peshawar City', 'code' => 'PSW-CITY', 'is_active' => true],
            ['district_id' => $peshawar->id, 'name' => 'Peshawar Cantonment', 'code' => 'PSW-CANT', 'is_active' => true],
            ['district_id' => $peshawar->id, 'name' => 'Hayatabad', 'code' => 'PSW-HB', 'is_active' => true],
            ['district_id' => $peshawar->id, 'name' => 'University Town', 'code' => 'PSW-UT', 'is_active' => true],

            // Quetta District Tehseels
            ['district_id' => $quetta->id, 'name' => 'Quetta City', 'code' => 'QTA-CITY', 'is_active' => true],
            ['district_id' => $quetta->id, 'name' => 'Quetta Cantonment', 'code' => 'QTA-CANT', 'is_active' => true],
            ['district_id' => $quetta->id, 'name' => 'Sariab', 'code' => 'QTA-SR', 'is_active' => true],

            // Islamabad District Tehseels
            ['district_id' => $islamabad->id, 'name' => 'Islamabad City', 'code' => 'ISB-CITY', 'is_active' => true],
            ['district_id' => $islamabad->id, 'name' => 'G-10 Sector', 'code' => 'ISB-G10', 'is_active' => true],
            ['district_id' => $islamabad->id, 'name' => 'F-6 Sector', 'code' => 'ISB-F6', 'is_active' => true],
            ['district_id' => $islamabad->id, 'name' => 'E-7 Sector', 'code' => 'ISB-E7', 'is_active' => true],

            // Faisalabad District Tehseels
            ['district_id' => $faisalabad->id, 'name' => 'Faisalabad City', 'code' => 'FSD-CITY', 'is_active' => true],
            ['district_id' => $faisalabad->id, 'name' => 'Faisalabad Cantonment', 'code' => 'FSD-CANT', 'is_active' => true],
            ['district_id' => $faisalabad->id, 'name' => 'Sadar', 'code' => 'FSD-SD', 'is_active' => true],
            ['district_id' => $faisalabad->id, 'name' => 'Jaranwala', 'code' => 'FSD-JW', 'is_active' => true],

            // Multan District Tehseels
            ['district_id' => $multan->id, 'name' => 'Multan City', 'code' => 'MUL-CITY', 'is_active' => true],
            ['district_id' => $multan->id, 'name' => 'Multan Cantonment', 'code' => 'MUL-CANT', 'is_active' => true],
            ['district_id' => $multan->id, 'name' => 'Bosan', 'code' => 'MUL-BS', 'is_active' => true],
            ['district_id' => $multan->id, 'name' => 'Shujabad', 'code' => 'MUL-SJ', 'is_active' => true],

            // Rawalpindi District Tehseels
            ['district_id' => $rawalpindi->id, 'name' => 'Rawalpindi City', 'code' => 'RWP-CITY', 'is_active' => true],
            ['district_id' => $rawalpindi->id, 'name' => 'Rawalpindi Cantonment', 'code' => 'RWP-CANT', 'is_active' => true],
            ['district_id' => $rawalpindi->id, 'name' => 'Saddar', 'code' => 'RWP-SD', 'is_active' => true],
            ['district_id' => $rawalpindi->id, 'name' => 'Taxila', 'code' => 'RWP-TX', 'is_active' => true],
        ];

        foreach ($tehseels as $tehseel) {
            Tehseel::create($tehseel);
        }
    }
}
