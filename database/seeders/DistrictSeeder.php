<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\District;
use App\Models\Province;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get provinces
        $punjab = Province::where('code', 'PB')->first();
        $sindh = Province::where('code', 'SD')->first();
        $kpk = Province::where('code', 'KP')->first();
        $balochistan = Province::where('code', 'BA')->first();
        $islamabad = Province::where('code', 'ICT')->first();
        $ajk = Province::where('code', 'AJK')->first();
        $gb = Province::where('code', 'GB')->first();

        $districts = [
            // Punjab Districts
            ['province_id' => $punjab->id, 'name' => 'Lahore', 'code' => 'LHR', 'is_active' => true],
            ['province_id' => $punjab->id, 'name' => 'Faisalabad', 'code' => 'FSD', 'is_active' => true],
            ['province_id' => $punjab->id, 'name' => 'Rawalpindi', 'code' => 'RWP', 'is_active' => true],
            ['province_id' => $punjab->id, 'name' => 'Multan', 'code' => 'MUL', 'is_active' => true],
            ['province_id' => $punjab->id, 'name' => 'Gujranwala', 'code' => 'GJR', 'is_active' => true],
            ['province_id' => $punjab->id, 'name' => 'Sialkot', 'code' => 'SKT', 'is_active' => true],
            ['province_id' => $punjab->id, 'name' => 'Sargodha', 'code' => 'SGD', 'is_active' => true],
            ['province_id' => $punjab->id, 'name' => 'Bahawalpur', 'code' => 'BWP', 'is_active' => true],
            ['province_id' => $punjab->id, 'name' => 'Dera Ghazi Khan', 'code' => 'DGK', 'is_active' => true],
            ['province_id' => $punjab->id, 'name' => 'Sahiwal', 'code' => 'SWL', 'is_active' => true],
            ['province_id' => $punjab->id, 'name' => 'Okara', 'code' => 'OKR', 'is_active' => true],
            ['province_id' => $punjab->id, 'name' => 'Sheikhupura', 'code' => 'SKP', 'is_active' => true],
            ['province_id' => $punjab->id, 'name' => 'Kasur', 'code' => 'KSR', 'is_active' => true],
            ['province_id' => $punjab->id, 'name' => 'Gujrat', 'code' => 'GRT', 'is_active' => true],
            ['province_id' => $punjab->id, 'name' => 'Mianwali', 'code' => 'MNL', 'is_active' => true],
            ['province_id' => $punjab->id, 'name' => 'Bhakkar', 'code' => 'BKR', 'is_active' => true],
            ['province_id' => $punjab->id, 'name' => 'Khushab', 'code' => 'KSB', 'is_active' => true],
            ['province_id' => $punjab->id, 'name' => 'Jhang', 'code' => 'JHG', 'is_active' => true],
            ['province_id' => $punjab->id, 'name' => 'Chiniot', 'code' => 'CNT', 'is_active' => true],
            ['province_id' => $punjab->id, 'name' => 'Toba Tek Singh', 'code' => 'TTS', 'is_active' => true],
            ['province_id' => $punjab->id, 'name' => 'Khanewal', 'code' => 'KNL', 'is_active' => true],
            ['province_id' => $punjab->id, 'name' => 'Lodhran', 'code' => 'LHRN', 'is_active' => true],
            ['province_id' => $punjab->id, 'name' => 'Vehari', 'code' => 'VHR', 'is_active' => true],
            ['province_id' => $punjab->id, 'name' => 'Rahim Yar Khan', 'code' => 'RYK', 'is_active' => true],
            ['province_id' => $punjab->id, 'name' => 'Muzaffargarh', 'code' => 'MFG', 'is_active' => true],
            ['province_id' => $punjab->id, 'name' => 'Layyah', 'code' => 'LYH', 'is_active' => true],
            ['province_id' => $punjab->id, 'name' => 'Rajanpur', 'code' => 'RJP', 'is_active' => true],
            ['province_id' => $punjab->id, 'name' => 'Attock', 'code' => 'ATK', 'is_active' => true],
            ['province_id' => $punjab->id, 'name' => 'Chakwal', 'code' => 'CKW', 'is_active' => true],
            ['province_id' => $punjab->id, 'name' => 'Jhelum', 'code' => 'JLM', 'is_active' => true],
            ['province_id' => $punjab->id, 'name' => 'Mandi Bahauddin', 'code' => 'MBD', 'is_active' => true],
            ['province_id' => $punjab->id, 'name' => 'Hafizabad', 'code' => 'HZB', 'is_active' => true],
            ['province_id' => $punjab->id, 'name' => 'Narowal', 'code' => 'NRW', 'is_active' => true],
            ['province_id' => $punjab->id, 'name' => 'Nankana Sahib', 'code' => 'NNS', 'is_active' => true],
            ['province_id' => $punjab->id, 'name' => 'Pakpattan', 'code' => 'PKP', 'is_active' => true],
            ['province_id' => $punjab->id, 'name' => 'Bahawalnagar', 'code' => 'BNG', 'is_active' => true],

            // Sindh Districts
            ['province_id' => $sindh->id, 'name' => 'Karachi', 'code' => 'KHI', 'is_active' => true],
            ['province_id' => $sindh->id, 'name' => 'Hyderabad', 'code' => 'HYD', 'is_active' => true],
            ['province_id' => $sindh->id, 'name' => 'Sukkur', 'code' => 'SKR', 'is_active' => true],
            ['province_id' => $sindh->id, 'name' => 'Larkana', 'code' => 'LRK', 'is_active' => true],
            ['province_id' => $sindh->id, 'name' => 'Mirpurkhas', 'code' => 'MPK', 'is_active' => true],
            ['province_id' => $sindh->id, 'name' => 'Nawabshah', 'code' => 'NWB', 'is_active' => true],
            ['province_id' => $sindh->id, 'name' => 'Jacobabad', 'code' => 'JCB', 'is_active' => true],
            ['province_id' => $sindh->id, 'name' => 'Shikarpur', 'code' => 'SKP', 'is_active' => true],
            ['province_id' => $sindh->id, 'name' => 'Khairpur', 'code' => 'KRP', 'is_active' => true],
            ['province_id' => $sindh->id, 'name' => 'Dadu', 'code' => 'DAD', 'is_active' => true],
            ['province_id' => $sindh->id, 'name' => 'Badin', 'code' => 'BDN', 'is_active' => true],
            ['province_id' => $sindh->id, 'name' => 'Thatta', 'code' => 'THA', 'is_active' => true],
            ['province_id' => $sindh->id, 'name' => 'Sanghar', 'code' => 'SGR', 'is_active' => true],
            ['province_id' => $sindh->id, 'name' => 'Naushahro Feroze', 'code' => 'NSF', 'is_active' => true],
            ['province_id' => $sindh->id, 'name' => 'Tando Muhammad Khan', 'code' => 'TMK', 'is_active' => true],
            ['province_id' => $sindh->id, 'name' => 'Tando Allahyar', 'code' => 'TAY', 'is_active' => true],
            ['province_id' => $sindh->id, 'name' => 'Matliari', 'code' => 'MTL', 'is_active' => true],
            ['province_id' => $sindh->id, 'name' => 'Umerkot', 'code' => 'UMK', 'is_active' => true],
            ['province_id' => $sindh->id, 'name' => 'Jamshoro', 'code' => 'JSH', 'is_active' => true],
            ['province_id' => $sindh->id, 'name' => 'Kashmore', 'code' => 'KSM', 'is_active' => true],
            ['province_id' => $sindh->id, 'name' => 'Qambar Shahdadkot', 'code' => 'QSK', 'is_active' => true],
            ['province_id' => $sindh->id, 'name' => 'Ghotki', 'code' => 'GTK', 'is_active' => true],
            ['province_id' => $sindh->id, 'name' => 'Shaheed Benazirabad', 'code' => 'SBA', 'is_active' => true],
            ['province_id' => $sindh->id, 'name' => 'Matiari', 'code' => 'MTR', 'is_active' => true],
            ['province_id' => $sindh->id, 'name' => 'Tando Allahyar', 'code' => 'TDY', 'is_active' => true],
            ['province_id' => $sindh->id, 'name' => 'Sujawal', 'code' => 'SJW', 'is_active' => true],

            // Khyber Pakhtunkhwa Districts
            ['province_id' => $kpk->id, 'name' => 'Peshawar', 'code' => 'PSW', 'is_active' => true],
            ['province_id' => $kpk->id, 'name' => 'Mardan', 'code' => 'MRD', 'is_active' => true],
            ['province_id' => $kpk->id, 'name' => 'Swabi', 'code' => 'SWB', 'is_active' => true],
            ['province_id' => $kpk->id, 'name' => 'Nowshera', 'code' => 'NSR', 'is_active' => true],
            ['province_id' => $kpk->id, 'name' => 'Charsadda', 'code' => 'CSD', 'is_active' => true],
            ['province_id' => $kpk->id, 'name' => 'Kohat', 'code' => 'KHT', 'is_active' => true],
            ['province_id' => $kpk->id, 'name' => 'Dera Ismail Khan', 'code' => 'DIK', 'is_active' => true],
            ['province_id' => $kpk->id, 'name' => 'Bannu', 'code' => 'BNU', 'is_active' => true],
            ['province_id' => $kpk->id, 'name' => 'Swat', 'code' => 'SWT', 'is_active' => true],
            ['province_id' => $kpk->id, 'name' => 'Malakand', 'code' => 'MLK', 'is_active' => true],
            ['province_id' => $kpk->id, 'name' => 'Lower Dir', 'code' => 'LDR', 'is_active' => true],
            ['province_id' => $kpk->id, 'name' => 'Upper Dir', 'code' => 'UDR', 'is_active' => true],
            ['province_id' => $kpk->id, 'name' => 'Chitral', 'code' => 'CTR', 'is_active' => true],
            ['province_id' => $kpk->id, 'name' => 'Shangla', 'code' => 'SGL', 'is_active' => true],
            ['province_id' => $kpk->id, 'name' => 'Buner', 'code' => 'BNR', 'is_active' => true],
            ['province_id' => $kpk->id, 'name' => 'Haripur', 'code' => 'HRP', 'is_active' => true],
            ['province_id' => $kpk->id, 'name' => 'Mansehra', 'code' => 'MNS', 'is_active' => true],
            ['province_id' => $kpk->id, 'name' => 'Abbottabad', 'code' => 'ABT', 'is_active' => true],
            ['province_id' => $kpk->id, 'name' => 'Batagram', 'code' => 'BTG', 'is_active' => true],
            ['province_id' => $kpk->id, 'name' => 'Kohistan', 'code' => 'KST', 'is_active' => true],
            ['province_id' => $kpk->id, 'name' => 'Torghar', 'code' => 'TGH', 'is_active' => true],
            ['province_id' => $kpk->id, 'name' => 'Tank', 'code' => 'TNK', 'is_active' => true],
            ['province_id' => $kpk->id, 'name' => 'Lakki Marwat', 'code' => 'LKM', 'is_active' => true],
            ['province_id' => $kpk->id, 'name' => 'Karak', 'code' => 'KRK', 'is_active' => true],
            ['province_id' => $kpk->id, 'name' => 'Hangu', 'code' => 'HNG', 'is_active' => true],
            ['province_id' => $kpk->id, 'name' => 'Dera Ismail Khan', 'code' => 'DIK', 'is_active' => true],
            ['province_id' => $kpk->id, 'name' => 'Peshawar', 'code' => 'PSW', 'is_active' => true],

            // Balochistan Districts
            ['province_id' => $balochistan->id, 'name' => 'Quetta', 'code' => 'QTA', 'is_active' => true],
            ['province_id' => $balochistan->id, 'name' => 'Gwadar', 'code' => 'GWD', 'is_active' => true],
            ['province_id' => $balochistan->id, 'name' => 'Turbat', 'code' => 'TRB', 'is_active' => true],
            ['province_id' => $balochistan->id, 'name' => 'Sibi', 'code' => 'SBI', 'is_active' => true],
            ['province_id' => $balochistan->id, 'name' => 'Loralai', 'code' => 'LRL', 'is_active' => true],
            ['province_id' => $balochistan->id, 'name' => 'Zhob', 'code' => 'ZHB', 'is_active' => true],
            ['province_id' => $balochistan->id, 'name' => 'Lasbela', 'code' => 'LSB', 'is_active' => true],
            ['province_id' => $balochistan->id, 'name' => 'Khuzdar', 'code' => 'KZD', 'is_active' => true],
            ['province_id' => $balochistan->id, 'name' => 'Jafarabad', 'code' => 'JFD', 'is_active' => true],
            ['province_id' => $balochistan->id, 'name' => 'Jhal Magsi', 'code' => 'JMG', 'is_active' => true],
            ['province_id' => $balochistan->id, 'name' => 'Kachhi', 'code' => 'KCH', 'is_active' => true],
            ['province_id' => $balochistan->id, 'name' => 'Sohbatpur', 'code' => 'SBP', 'is_active' => true],
            ['province_id' => $balochistan->id, 'name' => 'Nasirabad', 'code' => 'NSB', 'is_active' => true],
            ['province_id' => $balochistan->id, 'name' => 'Bolan', 'code' => 'BLN', 'is_active' => true],
            ['province_id' => $balochistan->id, 'name' => 'Mastung', 'code' => 'MTG', 'is_active' => true],
            ['province_id' => $balochistan->id, 'name' => 'Kalat', 'code' => 'KLT', 'is_active' => true],
            ['province_id' => $balochistan->id, 'name' => 'Kharan', 'code' => 'KRN', 'is_active' => true],
            ['province_id' => $balochistan->id, 'name' => 'Washuk', 'code' => 'WSK', 'is_active' => true],
            ['province_id' => $balochistan->id, 'name' => 'Chagai', 'code' => 'CGI', 'is_active' => true],
            ['province_id' => $balochistan->id, 'name' => 'Nushki', 'code' => 'NSK', 'is_active' => true],
            ['province_id' => $balochistan->id, 'name' => 'Dalbandin', 'code' => 'DBD', 'is_active' => true],
            ['province_id' => $balochistan->id, 'name' => 'Panjgur', 'code' => 'PJG', 'is_active' => true],
            ['province_id' => $balochistan->id, 'name' => 'Kech', 'code' => 'KCH', 'is_active' => true],
            ['province_id' => $balochistan->id, 'name' => 'Awaran', 'code' => 'AWN', 'is_active' => true],
            ['province_id' => $balochistan->id, 'name' => 'Khuzdar', 'code' => 'KZD', 'is_active' => true],
            ['province_id' => $balochistan->id, 'name' => 'Ziarat', 'code' => 'ZRT', 'is_active' => true],
            ['province_id' => $balochistan->id, 'name' => 'Pishin', 'code' => 'PSN', 'is_active' => true],
            ['province_id' => $balochistan->id, 'name' => 'Qilla Abdullah', 'code' => 'KLA', 'is_active' => true],
            ['province_id' => $balochistan->id, 'name' => 'Qilla Saifullah', 'code' => 'KLS', 'is_active' => true],
            ['province_id' => $balochistan->id, 'name' => 'Sherani', 'code' => 'SHR', 'is_active' => true],
            ['province_id' => $balochistan->id, 'name' => 'Musakhel', 'code' => 'MSK', 'is_active' => true],
            ['province_id' => $balochistan->id, 'name' => 'Barkhan', 'code' => 'BRK', 'is_active' => true],
            ['province_id' => $balochistan->id, 'name' => 'Loralai', 'code' => 'LRL', 'is_active' => true],
            ['province_id' => $balochistan->id, 'name' => 'Duki', 'code' => 'DKI', 'is_active' => true],
            ['province_id' => $balochistan->id, 'name' => 'Harnai', 'code' => 'HRN', 'is_active' => true],

            // Islamabad Capital Territory
            ['province_id' => $islamabad->id, 'name' => 'Islamabad', 'code' => 'ISB', 'is_active' => true],

            // Azad Kashmir Districts
            ['province_id' => $ajk->id, 'name' => 'Muzaffarabad', 'code' => 'MZD', 'is_active' => true],
            ['province_id' => $ajk->id, 'name' => 'Mirpur', 'code' => 'MRP', 'is_active' => true],
            ['province_id' => $ajk->id, 'name' => 'Bhimber', 'code' => 'BMB', 'is_active' => true],
            ['province_id' => $ajk->id, 'name' => 'Kotli', 'code' => 'KTL', 'is_active' => true],
            ['province_id' => $ajk->id, 'name' => 'Poonch', 'code' => 'PNH', 'is_active' => true],
            ['province_id' => $ajk->id, 'name' => 'Sudhanoti', 'code' => 'SDN', 'is_active' => true],
            ['province_id' => $ajk->id, 'name' => 'Bagh', 'code' => 'BGH', 'is_active' => true],
            ['province_id' => $ajk->id, 'name' => 'Hattian Bala', 'code' => 'HTB', 'is_active' => true],
            ['province_id' => $ajk->id, 'name' => 'Haveli', 'code' => 'HVL', 'is_active' => true],
            ['province_id' => $ajk->id, 'name' => 'Neelum', 'code' => 'NLM', 'is_active' => true],

            // Gilgit-Baltistan Districts
            ['province_id' => $gb->id, 'name' => 'Gilgit', 'code' => 'GLT', 'is_active' => true],
            ['province_id' => $gb->id, 'name' => 'Skardu', 'code' => 'SKD', 'is_active' => true],
            ['province_id' => $gb->id, 'name' => 'Ghanche', 'code' => 'GHC', 'is_active' => true],
            ['province_id' => $gb->id, 'name' => 'Shigar', 'code' => 'SGR', 'is_active' => true],
            ['province_id' => $gb->id, 'name' => 'Kharmang', 'code' => 'KMG', 'is_active' => true],
            ['province_id' => $gb->id, 'name' => 'Rondu', 'code' => 'RND', 'is_active' => true],
            ['province_id' => $gb->id, 'name' => 'Astore', 'code' => 'AST', 'is_active' => true],
            ['province_id' => $gb->id, 'name' => 'Diamer', 'code' => 'DMR', 'is_active' => true],
            ['province_id' => $gb->id, 'name' => 'Ghizer', 'code' => 'GZR', 'is_active' => true],
            ['province_id' => $gb->id, 'name' => 'Ghakuch', 'code' => 'GKC', 'is_active' => true],
            ['province_id' => $gb->id, 'name' => 'Hunza', 'code' => 'HNZ', 'is_active' => true],
            ['province_id' => $gb->id, 'name' => 'Nagar', 'code' => 'NGR', 'is_active' => true],
            ['province_id' => $gb->id, 'name' => 'Shigar', 'code' => 'SGR', 'is_active' => true],
            ['province_id' => $gb->id, 'name' => 'Skardu', 'code' => 'SKD', 'is_active' => true],
        ];

        foreach ($districts as $district) {
            District::create($district);
        }
    }
}
