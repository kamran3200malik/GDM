<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Rank;

class RankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ranks = [
            // Officer Ranks
            ['name' => 'Air Chief Marshal', 'rank_code' => 'ACM', 'is_active' => true],
            ['name' => 'Air Marshal', 'rank_code' => 'AM', 'is_active' => true],
            ['name' => 'Air Vice Marshal', 'rank_code' => 'AVM', 'is_active' => true],
            ['name' => 'Air Commodore', 'rank_code' => 'Air Cdr', 'is_active' => true],
            ['name' => 'Group Captain', 'rank_code' => 'Grp Capt', 'is_active' => true],
            ['name' => 'Wing Commander', 'rank_code' => 'Wg Cdr', 'is_active' => true],
            ['name' => 'Squadron Leader', 'rank_code' => 'Sqn Ldr', 'is_active' => true],
            ['name' => 'Flight Lieutenant', 'rank_code' => 'Flt Lt', 'is_active' => true],
            ['name' => 'Flying Officer', 'rank_code' => 'Fg Off', 'is_active' => true],
            ['name' => 'Pilot Officer', 'rank_code' => 'Plt Off', 'is_active' => true],

            // Airmen/Other Ranks
            ['name' => 'Master Warrant Officer', 'rank_code' => 'MWO', 'is_active' => true],
            ['name' => 'Warrant Officer', 'rank_code' => 'WO', 'is_active' => true],
            ['name' => 'Flight Sergeant', 'rank_code' => 'Flt Sgt', 'is_active' => true],
            ['name' => 'Sergeant', 'rank_code' => 'Sgt', 'is_active' => true],
            ['name' => 'Corporal', 'rank_code' => 'Cpl', 'is_active' => true],
            ['name' => 'Leading Aircraftman', 'rank_code' => 'LAC', 'is_active' => true],
            ['name' => 'Aircraftman', 'rank_code' => 'AC', 'is_active' => true],

            // Technical Ranks
            ['name' => 'Forman', 'rank_code' => 'FM', 'is_active' => true],
            ['name' => 'Assistant Forman', 'rank_code' => 'AFM', 'is_active' => true],
            ['name' => 'Chief Technician', 'rank_code' => 'CT', 'is_active' => true],
            ['name' => 'Senior Technician', 'rank_code' => 'ST', 'is_active' => true],
            ['name' => 'Corporal Technician', 'rank_code' => 'Cpl Tech', 'is_active' => true],
            ['name' => 'Junior Technician', 'rank_code' => 'JT', 'is_active' => true],

            // Trade Specific Ranks
            ['name' => 'CharHand', 'rank_code' => 'CH/H', 'is_active' => true],
            ['name' => 'MC_1', 'rank_code' => 'MC1', 'is_active' => true],
            ['name' => 'MC_2', 'rank_code' => 'MC2', 'is_active' => true],
            ['name' => 'MC_3', 'rank_code' => 'MC3', 'is_active' => true],
            ['name' => 'MT_1', 'rank_code' => 'MT1', 'is_active' => true],
            ['name' => 'MT_2', 'rank_code' => 'MT2', 'is_active' => true],
            ['name' => 'MT_3', 'rank_code' => 'MT3', 'is_active' => true],
            ['name' => 'PT_1', 'rank_code' => 'PT1', 'is_active' => true],
            ['name' => 'PT_2', 'rank_code' => 'PT2', 'is_active' => true],
            ['name' => 'PT_3', 'rank_code' => 'PT3', 'is_active' => true],
            ['name' => 'AT_1', 'rank_code' => 'AT1', 'is_active' => true],
            ['name' => 'AT_2', 'rank_code' => 'AT2', 'is_active' => true],
            ['name' => 'AT_3', 'rank_code' => 'AT3', 'is_active' => true],
            ['name' => 'GT_1', 'rank_code' => 'GT1', 'is_active' => true],
            ['name' => 'GT_2', 'rank_code' => 'GT2', 'is_active' => true],
            ['name' => 'GT_3', 'rank_code' => 'GT3', 'is_active' => true],
            ['name' => 'ET_1', 'rank_code' => 'ET1', 'is_active' => true],
            ['name' => 'ET_2', 'rank_code' => 'ET2', 'is_active' => true],
            ['name' => 'ET_3', 'rank_code' => 'ET3', 'is_active' => true],
            ['name' => 'RT_1', 'rank_code' => 'RT1', 'is_active' => true],
            ['name' => 'RT_2', 'rank_code' => 'RT2', 'is_active' => true],
            ['name' => 'RT_3', 'rank_code' => 'RT3', 'is_active' => true],
            ['name' => 'ST_1', 'rank_code' => 'ST1', 'is_active' => true],
            ['name' => 'ST_2', 'rank_code' => 'ST2', 'is_active' => true],
            ['name' => 'ST_3', 'rank_code' => 'ST3', 'is_active' => true],
            ['name' => 'FT_1', 'rank_code' => 'FT1', 'is_active' => true],
            ['name' => 'FT_2', 'rank_code' => 'FT2', 'is_active' => true],
            ['name' => 'FT_3', 'rank_code' => 'FT3', 'is_active' => true],
            ['name' => 'IT_1', 'rank_code' => 'IT1', 'is_active' => true],
            ['name' => 'IT_2', 'rank_code' => 'IT2', 'is_active' => true],
            ['name' => 'IT_3', 'rank_code' => 'IT3', 'is_active' => true],
            ['name' => 'WT_1', 'rank_code' => 'WT1', 'is_active' => true],
            ['name' => 'WT_2', 'rank_code' => 'WT2', 'is_active' => true],
            ['name' => 'WT_3', 'rank_code' => 'WT3', 'is_active' => true],
            ['name' => 'CT_1', 'rank_code' => 'CT1', 'is_active' => true],
            ['name' => 'CT_2', 'rank_code' => 'CT2', 'is_active' => true],
            ['name' => 'CT_3', 'rank_code' => 'CT3', 'is_active' => true],
            ['name' => 'LT_1', 'rank_code' => 'LT1', 'is_active' => true],
            ['name' => 'LT_2', 'rank_code' => 'LT2', 'is_active' => true],
            ['name' => 'LT_3', 'rank_code' => 'LT3', 'is_active' => true],
            ['name' => 'DT_1', 'rank_code' => 'DT1', 'is_active' => true],
            ['name' => 'DT_2', 'rank_code' => 'DT2', 'is_active' => true],
            ['name' => 'DT_3', 'rank_code' => 'DT3', 'is_active' => true],
        ];

        foreach ($ranks as $rank) {
            Rank::create($rank);
        }
    }
}
