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
        $faisalabad = District::where('code', 'FSD')->first();
        $rawalpindi = District::where('code', 'RWP')->first();
        $multan = District::where('code', 'MUL')->first();
        $gujranwala = District::where('code', 'GJR')->first();
        $sialkot = District::where('code', 'SKT')->first();
        $sargodha = District::where('code', 'SGD')->first();
        $bahawalpur = District::where('code', 'BWP')->first();
        $dera_ghazi_khan = District::where('code', 'DGK')->first();
        $sahiwal = District::where('code', 'SWL')->first();
        $okara = District::where('code', 'OKR')->first();
        $sheikhupura = District::where('code', 'SKP')->first();
        $kasur = District::where('code', 'KSR')->first();
        $gujrat = District::where('code', 'GRT')->first();
        $mianwali = District::where('code', 'MNL')->first();
        $bhakkar = District::where('code', 'BKR')->first();
        $khushab = District::where('code', 'KSB')->first();
        $jhang = District::where('code', 'JHG')->first();
        $chiniot = District::where('code', 'CNT')->first();
        $toba_tek_singh = District::where('code', 'TTS')->first();
        $khanewal = District::where('code', 'KNL')->first();
        $lodhran = District::where('code', 'LHRN')->first();
        $vehari = District::where('code', 'VHR')->first();
        $rahim_yar_khan = District::where('code', 'RYK')->first();
        $muzaffargarh = District::where('code', 'MFG')->first();
        $layyah = District::where('code', 'LYH')->first();
        $rajanpur = District::where('code', 'RJP')->first();
        $attock = District::where('code', 'ATK')->first();
        $chakwal = District::where('code', 'CKW')->first();
        $jhelum = District::where('code', 'JLM')->first();
        $mandi_bahauddin = District::where('code', 'MBD')->first();
        $hafizabad = District::where('code', 'HZB')->first();
        $narowal = District::where('code', 'NRW')->first();
        $nankana_sahib = District::where('code', 'NNS')->first();
        $pakpattan = District::where('code', 'PKP')->first();
        $bahawalnagar = District::where('code', 'BNG')->first();

        $karachi = District::where('code', 'KHI')->first();
        $hyderabad = District::where('code', 'HYD')->first();
        $sukkur = District::where('code', 'SKR')->first();
        $larkana = District::where('code', 'LRK')->first();
        $mirpurkhas = District::where('code', 'MPK')->first();
        $nawabshah = District::where('code', 'NWB')->first();
        $jacobabad = District::where('code', 'JCB')->first();
        $shikarpur = District::where('code', 'SKP')->first();
        $khairpur = District::where('code', 'KRP')->first();
        $dadu = District::where('code', 'DAD')->first();
        $badin = District::where('code', 'BDN')->first();
        $thatta = District::where('code', 'THA')->first();
        $sanghar = District::where('code', 'SGR')->first();
        $naushahro_feroze = District::where('code', 'NSF')->first();
        $tando_muhammad_khan = District::where('code', 'TMK')->first();
        $tando_allahyar = District::where('code', 'TAY')->first();
        $matliari = District::where('code', 'MTL')->first();
        $umerkot = District::where('code', 'UMK')->first();
        $jamshoro = District::where('code', 'JSH')->first();
        $kashmore = District::where('code', 'KSM')->first();
        $qambar_shahdadkot = District::where('code', 'QSK')->first();
        $ghotki = District::where('code', 'GTK')->first();
        $shaheed_benazirabad = District::where('code', 'SBA')->first();
        $matiari = District::where('code', 'MTR')->first();
        $sujawal = District::where('code', 'SJW')->first();

        $peshawar = District::where('code', 'PSW')->first();
        $mardan = District::where('code', 'MRD')->first();
        $swabi = District::where('code', 'SWB')->first();
        $nowshera = District::where('code', 'NSR')->first();
        $charsadda = District::where('code', 'CSD')->first();
        $kohat = District::where('code', 'KHT')->first();
        $dera_ismail_khan = District::where('code', 'DIK')->first();
        $bannu = District::where('code', 'BNU')->first();
        $swat = District::where('code', 'SWT')->first();
        $malakand = District::where('code', 'MLK')->first();
        $lower_dir = District::where('code', 'LDR')->first();
        $upper_dir = District::where('code', 'UDR')->first();
        $chitral = District::where('code', 'CTR')->first();
        $shangla = District::where('code', 'SGL')->first();
        $buner = District::where('code', 'BNR')->first();
        $haripur = District::where('code', 'HRP')->first();
        $mansehra = District::where('code', 'MNS')->first();
        $abbottabad = District::where('code', 'ABT')->first();
        $batagram = District::where('code', 'BTG')->first();
        $kohistan = District::where('code', 'KST')->first();
        $torghar = District::where('code', 'TGH')->first();
        $tank = District::where('code', 'TNK')->first();
        $lakki_marwat = District::where('code', 'LKM')->first();
        $karak = District::where('code', 'KRK')->first();
        $hangu = District::where('code', 'HNG')->first();

        $quetta = District::where('code', 'QTA')->first();
        $gwadar = District::where('code', 'GWD')->first();
        $turbat = District::where('code', 'TRB')->first();
        $sibi = District::where('code', 'SBI')->first();
        $loralai = District::where('code', 'LRL')->first();
        $zhob = District::where('code', 'ZHB')->first();
        $lasbela = District::where('code', 'LSB')->first();
        $khuzdar = District::where('code', 'KZD')->first();
        $jafarabad = District::where('code', 'JFD')->first();
        $jhal_magsi = District::where('code', 'JMG')->first();
        $kachhi = District::where('code', 'KCH')->first();
        $sohbatpur = District::where('code', 'SBP')->first();
        $nasirabad = District::where('code', 'NSB')->first();
        $bolan = District::where('code', 'BLN')->first();
        $mastung = District::where('code', 'MTG')->first();
        $kalat = District::where('code', 'KLT')->first();
        $kharan = District::where('code', 'KRN')->first();
        $washuk = District::where('code', 'WSK')->first();
        $chagai = District::where('code', 'CGI')->first();
        $nushki = District::where('code', 'NSK')->first();
        $dalbandin = District::where('code', 'DBD')->first();
        $panjgur = District::where('code', 'PJG')->first();
        $kech = District::where('code', 'KCH')->first();
        $awaran = District::where('code', 'AWN')->first();
        $ziarat = District::where('code', 'ZRT')->first();
        $pishin = District::where('code', 'PSN')->first();
        $qilla_abdullah = District::where('code', 'KLA')->first();
        $qilla_saifullah = District::where('code', 'KLS')->first();
        $sherani = District::where('code', 'SHR')->first();
        $musakhel = District::where('code', 'MSK')->first();
        $barkhan = District::where('code', 'BRK')->first();
        $duki = District::where('code', 'DKI')->first();
        $harnai = District::where('code', 'HRN')->first();

        $islamabad = District::where('code', 'ISB')->first();

        $muzaffarabad = District::where('code', 'MZD')->first();
        $mirpur = District::where('code', 'MRP')->first();
        $bhimber = District::where('code', 'BMB')->first();
        $kotli = District::where('code', 'KTL')->first();
        $poonch = District::where('code', 'PNH')->first();
        $sudhanoti = District::where('code', 'SDN')->first();
        $bagh = District::where('code', 'BGH')->first();
        $hattian_bala = District::where('code', 'HTB')->first();
        $haveli = District::where('code', 'HVL')->first();
        $neelum = District::where('code', 'NLM')->first();

        $gilgit = District::where('code', 'GLT')->first();
        $skardu = District::where('code', 'SKD')->first();
        $ghanche = District::where('code', 'GHC')->first();
        $shigar = District::where('code', 'SGR')->first();
        $kharmang = District::where('code', 'KMG')->first();
        $rondu = District::where('code', 'RND')->first();
        $astore = District::where('code', 'AST')->first();
        $diamer = District::where('code', 'DMR')->first();
        $ghizer = District::where('code', 'GZR')->first();
        $ghakuch = District::where('code', 'GKC')->first();
        $hunza = District::where('code', 'HNZ')->first();
        $nagar = District::where('code', 'NGR')->first();

        $tehseels = [
            // Lahore District Tehseels
            ['district_id' => $lahore->id, 'name' => 'Lahore City', 'code' => 'LHR-CITY', 'is_active' => true],
            ['district_id' => $lahore->id, 'name' => 'Lahore Cantonment', 'code' => 'LHR-CANT', 'is_active' => true],
            ['district_id' => $lahore->id, 'name' => 'Model Town', 'code' => 'LHR-MT', 'is_active' => true],
            ['district_id' => $lahore->id, 'name' => 'Gulberg', 'code' => 'LHR-GB', 'is_active' => true],
            ['district_id' => $lahore->id, 'name' => 'Shalimar', 'code' => 'LHR-SH', 'is_active' => true],
            ['district_id' => $lahore->id, 'name' => 'Iqbal Town', 'code' => 'LHR-IT', 'is_active' => true],
            ['district_id' => $lahore->id, 'name' => 'Samnabad', 'code' => 'LHR-SB', 'is_active' => true],
            ['district_id' => $lahore->id, 'name' => 'Gulshan Ravi', 'code' => 'LHR-GR', 'is_active' => true],
            ['district_id' => $lahore->id, 'name' => 'Wagah', 'code' => 'LHR-WG', 'is_active' => true],
            ['district_id' => $lahore->id, 'name' => 'Aziz Bhatti', 'code' => 'LHR-AB', 'is_active' => true],

            // Faisalabad District Tehseels
            ['district_id' => $faisalabad->id, 'name' => 'Faisalabad City', 'code' => 'FSD-CITY', 'is_active' => true],
            ['district_id' => $faisalabad->id, 'name' => 'Faisalabad Cantonment', 'code' => 'FSD-CANT', 'is_active' => true],
            ['district_id' => $faisalabad->id, 'name' => 'Sadar', 'code' => 'FSD-SD', 'is_active' => true],
            ['district_id' => $faisalabad->id, 'name' => 'Jaranwala', 'code' => 'FSD-JW', 'is_active' => true],
            ['district_id' => $faisalabad->id, 'name' => 'Chak Jhumra', 'code' => 'FSD-CJ', 'is_active' => true],
            ['district_id' => $faisalabad->id, 'name' => 'Samundri', 'code' => 'FSD-SM', 'is_active' => true],
            ['district_id' => $faisalabad->id, 'name' => 'Tandlianwala', 'code' => 'FSD-TW', 'is_active' => true],

            // Rawalpindi District Tehseels
            ['district_id' => $rawalpindi->id, 'name' => 'Rawalpindi City', 'code' => 'RWP-CITY', 'is_active' => true],
            ['district_id' => $rawalpindi->id, 'name' => 'Rawalpindi Cantonment', 'code' => 'RWP-CANT', 'is_active' => true],
            ['district_id' => $rawalpindi->id, 'name' => 'Saddar', 'code' => 'RWP-SD', 'is_active' => true],
            ['district_id' => $rawalpindi->id, 'name' => 'Taxila', 'code' => 'RWP-TX', 'is_active' => true],
            ['district_id' => $rawalpindi->id, 'name' => 'Murree', 'code' => 'RWP-MR', 'is_active' => true],
            ['district_id' => $rawalpindi->id, 'name' => 'Kahuta', 'code' => 'RWP-KT', 'is_active' => true],
            ['district_id' => $rawalpindi->id, 'name' => 'Gujar Khan', 'code' => 'RWP-GK', 'is_active' => true],

            // Multan District Tehseels
            ['district_id' => $multan->id, 'name' => 'Multan City', 'code' => 'MUL-CITY', 'is_active' => true],
            ['district_id' => $multan->id, 'name' => 'Multan Cantonment', 'code' => 'MUL-CANT', 'is_active' => true],
            ['district_id' => $multan->id, 'name' => 'Bosan', 'code' => 'MUL-BS', 'is_active' => true],
            ['district_id' => $multan->id, 'name' => 'Shujabad', 'code' => 'MUL-SJ', 'is_active' => true],
            ['district_id' => $multan->id, 'name' => 'Jalalpur Pirwala', 'code' => 'MUL-JP', 'is_active' => true],
            ['district_id' => $multan->id, 'name' => 'Kot Addu', 'code' => 'MUL-KA', 'is_active' => true],

            // Gujranwala District Tehseels
            ['district_id' => $gujranwala->id, 'name' => 'Gujranwala City', 'code' => 'GJR-CITY', 'is_active' => true],
            ['district_id' => $gujranwala->id, 'name' => 'Gujranwala Cantonment', 'code' => 'GJR-CANT', 'is_active' => true],
            ['district_id' => $gujranwala->id, 'name' => 'Wazirabad', 'code' => 'GJR-WZ', 'is_active' => true],
            ['district_id' => $gujranwala->id, 'name' => 'Kamoke', 'code' => 'GJR-KM', 'is_active' => true],
            ['district_id' => $gujranwala->id, 'name' => 'Nowshera Virkan', 'code' => 'GJR-NV', 'is_active' => true],

            // Sialkot District Tehseels
            ['district_id' => $sialkot->id, 'name' => 'Sialkot City', 'code' => 'SKT-CITY', 'is_active' => true],
            ['district_id' => $sialkot->id, 'name' => 'Sialkot Cantonment', 'code' => 'SKT-CANT', 'is_active' => true],
            ['district_id' => $sialkot->id, 'name' => 'Daska', 'code' => 'SKT-DS', 'is_active' => true],
            ['district_id' => $sialkot->id, 'name' => 'Pasrur', 'code' => 'SKT-PR', 'is_active' => true],
            ['district_id' => $sialkot->id, 'name' => 'Zafarwal', 'code' => 'SKT-ZW', 'is_active' => true],

            // Sargodha District Tehseels
            ['district_id' => $sargodha->id, 'name' => 'Sargodha City', 'code' => 'SGD-CITY', 'is_active' => true],
            ['district_id' => $sargodha->id, 'name' => 'Sargodha Cantonment', 'code' => 'SGD-CANT', 'is_active' => true],
            ['district_id' => $sargodha->id, 'name' => 'Bhalwal', 'code' => 'SGD-BW', 'is_active' => true],
            ['district_id' => $sargodha->id, 'name' => 'Sahiwal', 'code' => 'SGD-SW', 'is_active' => true],
            ['district_id' => $sargodha->id, 'name' => 'Kot Momin', 'code' => 'SGD-KM', 'is_active' => true],

            // Bahawalpur District Tehseels
            ['district_id' => $bahawalpur->id, 'name' => 'Bahawalpur City', 'code' => 'BWP-CITY', 'is_active' => true],
            ['district_id' => $bahawalpur->id, 'name' => 'Bahawalpur Cantonment', 'code' => 'BWP-CANT', 'is_active' => true],
            ['district_id' => $bahawalpur->id, 'name' => 'Ahmadpur East', 'code' => 'BWP-AE', 'is_active' => true],
            ['district_id' => $bahawalpur->id, 'name' => 'Yazman', 'code' => 'BWP-YZ', 'is_active' => true],
            ['district_id' => $bahawalpur->id, 'name' => 'Hasilpur', 'code' => 'BWP-HP', 'is_active' => true],

            // Dera Ghazi Khan District Tehseels
            ['district_id' => $dera_ghazi_khan->id, 'name' => 'Dera Ghazi Khan City', 'code' => 'DGK-CITY', 'is_active' => true],
            ['district_id' => $dera_ghazi_khan->id, 'name' => 'Taunsa Sharif', 'code' => 'DGK-TS', 'is_active' => true],
            ['district_id' => $dera_ghazi_khan->id, 'name' => 'Jampur', 'code' => 'DGK-JP', 'is_active' => true],
            ['district_id' => $dera_ghazi_khan->id, 'name' => 'Dajal', 'code' => 'DGK-DJ', 'is_active' => true],

            // Sahiwal District Tehseels
            ['district_id' => $sahiwal->id, 'name' => 'Sahiwal City', 'code' => 'SWL-CITY', 'is_active' => true],
            ['district_id' => $sahiwal->id, 'name' => 'Sahiwal Cantonment', 'code' => 'SWL-CANT', 'is_active' => true],
            ['district_id' => $sahiwal->id, 'name' => 'Chichawatni', 'code' => 'SWL-CC', 'is_active' => true],
            ['district_id' => $sahiwal->id, 'name' => 'Harappa', 'code' => 'SWL-HP', 'is_active' => true],

            // Okara District Tehseels
            ['district_id' => $okara->id, 'name' => 'Okara City', 'code' => 'OKR-CITY', 'is_active' => true],
            ['district_id' => $okara->id, 'name' => 'Okara Cantonment', 'code' => 'OKR-CANT', 'is_active' => true],
            ['district_id' => $okara->id, 'name' => 'Depalpur', 'code' => 'OKR-DP', 'is_active' => true],
            ['district_id' => $okara->id, 'name' => 'Renala Khurd', 'code' => 'OKR-RK', 'is_active' => true],

            // Sheikhupura District Tehseels
            ['district_id' => $sheikhupura->id, 'name' => 'Sheikhupura City', 'code' => 'SKP-CITY', 'is_active' => true],
            ['district_id' => $sheikhupura->id, 'name' => 'Safdarabad', 'code' => 'SKP-SB', 'is_active' => true],
            ['district_id' => $sheikhupura->id, 'name' => 'Muridke', 'code' => 'SKP-MK', 'is_active' => true],
            ['district_id' => $sheikhupura->id, 'name' => 'Ferozewala', 'code' => 'SKP-FW', 'is_active' => true],

            // Kasur District Tehseels
            ['district_id' => $kasur->id, 'name' => 'Kasur City', 'code' => 'KSR-CITY', 'is_active' => true],
            ['district_id' => $kasur->id, 'name' => 'Kasur Cantonment', 'code' => 'KSR-CANT', 'is_active' => true],
            ['district_id' => $kasur->id, 'name' => 'Chunian', 'code' => 'KSR-CN', 'is_active' => true],
            ['district_id' => $kasur->id, 'name' => 'Pattoki', 'code' => 'KSR-PT', 'is_active' => true],
            ['district_id' => $kasur->id, 'name' => 'Bhai Pheru', 'code' => 'KSR-BP', 'is_active' => true],

            // Gujrat District Tehseels
            ['district_id' => $gujrat->id, 'name' => 'Gujrat City', 'code' => 'GRT-CITY', 'is_active' => true],
            ['district_id' => $gujrat->id, 'name' => 'Gujrat Cantonment', 'code' => 'GRT-CANT', 'is_active' => true],
            ['district_id' => $gujrat->id, 'name' => 'Lalamusa', 'code' => 'GRT-LL', 'is_active' => true],
            ['district_id' => $gujrat->id, 'name' => 'Sarai Alamgir', 'code' => 'GRT-SA', 'is_active' => true],
            ['district_id' => $gujrat->id, 'name' => 'Kunjah', 'code' => 'GRT-KJ', 'is_active' => true],

            // Mianwali District Tehseels
            ['district_id' => $mianwali->id, 'name' => 'Mianwali City', 'code' => 'MNL-CITY', 'is_active' => true],
            ['district_id' => $mianwali->id, 'name' => 'Isakhel', 'code' => 'MNL-IS', 'is_active' => true],
            ['district_id' => $mianwali->id, 'name' => 'Piplan', 'code' => 'MNL-PL', 'is_active' => true],
            ['district_id' => $mianwali->id, 'name' => 'Kundian', 'code' => 'MNL-KD', 'is_active' => true],

            // Bhakkar District Tehseels
            ['district_id' => $bhakkar->id, 'name' => 'Bhakkar City', 'code' => 'BKR-CITY', 'is_active' => true],
            ['district_id' => $bhakkar->id, 'name' => 'Darya Khan', 'code' => 'BKR-DK', 'is_active' => true],
            ['district_id' => $bhakkar->id, 'name' => 'Kaloorkot', 'code' => 'BKR-KK', 'is_active' => true],
            ['district_id' => $bhakkar->id, 'name' => 'Mankera', 'code' => 'BKR-MK', 'is_active' => true],

            // Khushab District Tehseels
            ['district_id' => $khushab->id, 'name' => 'Khushab City', 'code' => 'KSB-CITY', 'is_active' => true],
            ['district_id' => $khushab->id, 'name' => 'Noonpur', 'code' => 'KSB-NP', 'is_active' => true],
            ['district_id' => $khushab->id, 'name' => 'Quaidabad', 'code' => 'KSB-QB', 'is_active' => true],
            ['district_id' => $khushab->id, 'name' => 'Jauharabad', 'code' => 'KSB-JB', 'is_active' => true],

            // Jhang District Tehseels
            ['district_id' => $jhang->id, 'name' => 'Jhang City', 'code' => 'JHG-CITY', 'is_active' => true],
            ['district_id' => $jhang->id, 'name' => 'Jhang Sadar', 'code' => 'JHG-SD', 'is_active' => true],
            ['district_id' => $jhang->id, 'name' => 'Shorkot', 'code' => 'JHG-SK', 'is_active' => true],
            ['district_id' => $jhang->id, 'name' => 'Ahmadpur Sial', 'code' => 'JHG-AS', 'is_active' => true],
            ['district_id' => $jhang->id, 'name' => 'Athara Hazari', 'code' => 'JHG-AH', 'is_active' => true],

            // Chiniot District Tehseels
            ['district_id' => $chiniot->id, 'name' => 'Chiniot City', 'code' => 'CNT-CITY', 'is_active' => true],
            ['district_id' => $chiniot->id, 'name' => 'Lalian', 'code' => 'CNT-LL', 'is_active' => true],
            ['district_id' => $chiniot->id, 'name' => 'Bhowana', 'code' => 'CNT-BW', 'is_active' => true],
            ['district_id' => $chiniot->id, 'name' => 'Chiniot Cantonment', 'code' => 'CNT-CANT', 'is_active' => true],

            // Toba Tek Singh District Tehseels
            ['district_id' => $toba_tek_singh->id, 'name' => 'Toba Tek Singh City', 'code' => 'TTS-CITY', 'is_active' => true],
            ['district_id' => $toba_tek_singh->id, 'name' => 'Gojra', 'code' => 'TTS-GJ', 'is_active' => true],
            ['district_id' => $toba_tek_singh->id, 'name' => 'Kamalia', 'code' => 'TTS-KM', 'is_active' => true],
            ['district_id' => $toba_tek_singh->id, 'name' => 'Pirmahal', 'code' => 'TTS-PM', 'is_active' => true],

            // Khanewal District Tehseels
            ['district_id' => $khanewal->id, 'name' => 'Khanewal City', 'code' => 'KNL-CITY', 'is_active' => true],
            ['district_id' => $khanewal->id, 'name' => 'Kabirwala', 'code' => 'KNL-KB', 'is_active' => true],
            ['district_id' => $khanewal->id, 'name' => 'Mian Channu', 'code' => 'KNL-MC', 'is_active' => true],
            ['district_id' => $khanewal->id, 'name' => 'Jahanian', 'code' => 'KNL-JH', 'is_active' => true],

            // Lodhran District Tehseels
            ['district_id' => $lodhran->id, 'name' => 'Lodhran City', 'code' => 'LHRN-CITY', 'is_active' => true],
            ['district_id' => $lodhran->id, 'name' => 'Dunyapur', 'code' => 'LHRN-DP', 'is_active' => true],
            ['district_id' => $lodhran->id, 'name' => 'Kahror Pakka', 'code' => 'LHRN-KP', 'is_active' => true],

            // Vehari District Tehseels
            ['district_id' => $vehari->id, 'name' => 'Vehari City', 'code' => 'VHR-CITY', 'is_active' => true],
            ['district_id' => $vehari->id, 'name' => 'Burewala', 'code' => 'VHR-BW', 'is_active' => true],
            ['district_id' => $vehari->id, 'name' => 'Mailsi', 'code' => 'VHR-MS', 'is_active' => true],
            ['district_id' => $vehari->id, 'name' => 'Gaggu Mandi', 'code' => 'VHR-GM', 'is_active' => true],

            // Rahim Yar Khan District Tehseels
            ['district_id' => $rahim_yar_khan->id, 'name' => 'Rahim Yar Khan City', 'code' => 'RYK-CITY', 'is_active' => true],
            ['district_id' => $rahim_yar_khan->id, 'name' => 'Sadiqabad', 'code' => 'RYK-SD', 'is_active' => true],
            ['district_id' => $rahim_yar_khan->id, 'name' => 'Liaquatpur', 'code' => 'RYK-LP', 'is_active' => true],
            ['district_id' => $rahim_yar_khan->id, 'name' => 'Khanpur', 'code' => 'RYK-KP', 'is_active' => true],

            // Muzaffargarh District Tehseels
            ['district_id' => $muzaffargarh->id, 'name' => 'Muzaffargarh City', 'code' => 'MFG-CITY', 'is_active' => true],
            ['district_id' => $muzaffargarh->id, 'name' => 'Alipur', 'code' => 'MFG-AP', 'is_active' => true],
            ['district_id' => $muzaffargarh->id, 'name' => 'Jatoi', 'code' => 'MFG-JT', 'is_active' => true],
            ['district_id' => $muzaffargarh->id, 'name' => 'Kot Addu', 'code' => 'MFG-KA', 'is_active' => true],
            ['district_id' => $muzaffargarh->id, 'name' => 'Sanawan', 'code' => 'MFG-SW', 'is_active' => true],

            // Layyah District Tehseels
            ['district_id' => $layyah->id, 'name' => 'Layyah City', 'code' => 'LYH-CITY', 'is_active' => true],
            ['district_id' => $layyah->id, 'name' => 'Chowk Azam', 'code' => 'LYH-CA', 'is_active' => true],
            ['district_id' => $layyah->id, 'name' => 'Karor Lal Esan', 'code' => 'LYH-KL', 'is_active' => true],
            ['district_id' => $layyah->id, 'name' => 'Fatehpur', 'code' => 'LYH-FP', 'is_active' => true],

            // Rajanpur District Tehseels
            ['district_id' => $rajanpur->id, 'name' => 'Rajanpur City', 'code' => 'RJP-CITY', 'is_active' => true],
            ['district_id' => $rajanpur->id, 'name' => 'Jampur', 'code' => 'RJP-JP', 'is_active' => true],
            ['district_id' => $rajanpur->id, 'name' => 'Rojhan', 'code' => 'RJP-RJ', 'is_active' => true],
            ['district_id' => $rajanpur->id, 'name' => 'Noorpur Thal', 'code' => 'RJP-NT', 'is_active' => true],

            // Attock District Tehseels
            ['district_id' => $attock->id, 'name' => 'Attock City', 'code' => 'ATK-CITY', 'is_active' => true],
            ['district_id' => $attock->id, 'name' => 'Hazro', 'code' => 'ATK-HZ', 'is_active' => true],
            ['district_id' => $attock->id, 'name' => 'Fateh Jang', 'code' => 'ATK-FJ', 'is_active' => true],
            ['district_id' => $attock->id, 'name' => 'Pindi Gheb', 'code' => 'ATK-PG', 'is_active' => true],
            ['district_id' => $attock->id, 'name' => 'Hassan Abdal', 'code' => 'ATK-HA', 'is_active' => true],

            // Chakwal District Tehseels
            ['district_id' => $chakwal->id, 'name' => 'Chakwal City', 'code' => 'CKW-CITY', 'is_active' => true],
            ['district_id' => $chakwal->id, 'name' => 'Talagang', 'code' => 'CKW-TG', 'is_active' => true],
            ['district_id' => $chakwal->id, 'name' => 'Choa Saidan Shah', 'code' => 'CKW-CS', 'is_active' => true],
            ['district_id' => $chakwal->id, 'name' => 'Kallar Kahar', 'code' => 'CKW-KK', 'is_active' => true],

            // Jhelum District Tehseels
            ['district_id' => $jhelum->id, 'name' => 'Jhelum City', 'code' => 'JLM-CITY', 'is_active' => true],
            ['district_id' => $jhelum->id, 'name' => 'Sarai Alamgir', 'code' => 'JLM-SA', 'is_active' => true],
            ['district_id' => $jhelum->id, 'name' => 'Pind Dadan Khan', 'code' => 'JLM-PD', 'is_active' => true],
            ['district_id' => $jhelum->id, 'name' => 'Dina', 'code' => 'JLM-DN', 'is_active' => true],
            ['district_id' => $jhelum->id, 'name' => 'Sohawa', 'code' => 'JLM-SW', 'is_active' => true],

            // Mandi Bahauddin District Tehseels
            ['district_id' => $mandi_bahauddin->id, 'name' => 'Mandi Bahauddin City', 'code' => 'MBD-CITY', 'is_active' => true],
            ['district_id' => $mandi_bahauddin->id, 'name' => 'Phalia', 'code' => 'MBD-PH', 'is_active' => true],
            ['district_id' => $mandi_bahauddin->id, 'name' => 'Malakwal', 'code' => 'MBD-MK', 'is_active' => true],
            ['district_id' => $mandi_bahauddin->id, 'name' => 'Gojra', 'code' => 'MBD-GJ', 'is_active' => true],

            // Hafizabad District Tehseels
            ['district_id' => $hafizabad->id, 'name' => 'Hafizabad City', 'code' => 'HZB-CITY', 'is_active' => true],
            ['district_id' => $hafizabad->id, 'name' => 'Pindi Bhattian', 'code' => 'HZB-PB', 'is_active' => true],
            ['district_id' => $hafizabad->id, 'name' => 'Safdarabad', 'code' => 'HZB-SB', 'is_active' => true],

            // Narowal District Tehseels
            ['district_id' => $narowal->id, 'name' => 'Narowal City', 'code' => 'NRW-CITY', 'is_active' => true],
            ['district_id' => $narowal->id, 'name' => 'Zafarwal', 'code' => 'NRW-ZW', 'is_active' => true],
            ['district_id' => $narowal->id, 'name' => 'Shakargarh', 'code' => 'NRW-SK', 'is_active' => true],

            // Nankana Sahib District Tehseels
            ['district_id' => $nankana_sahib->id, 'name' => 'Nankana Sahib City', 'code' => 'NNS-CITY', 'is_active' => true],
            ['district_id' => $nankana_sahib->id, 'name' => 'Sangla Hill', 'code' => 'NNS-SH', 'is_active' => true],
            ['district_id' => $nankana_sahib->id, 'name' => 'Shahkot', 'code' => 'NNS-SK', 'is_active' => true],

            // Pakpattan District Tehseels
            ['district_id' => $pakpattan->id, 'name' => 'Pakpattan City', 'code' => 'PKP-CITY', 'is_active' => true],
            ['district_id' => $pakpattan->id, 'name' => 'Arifwala', 'code' => 'PKP-AW', 'is_active' => true],
            ['district_id' => $pakpattan->id, 'name' => 'Qadirpur Raan', 'code' => 'PKP-QR', 'is_active' => true],

            // Bahawalnagar District Tehseels
            ['district_id' => $bahawalnagar->id, 'name' => 'Bahawalnagar City', 'code' => 'BNG-CITY', 'is_active' => true],
            ['district_id' => $bahawalnagar->id, 'name' => 'Haroonabad', 'code' => 'BNG-HB', 'is_active' => true],
            ['district_id' => $bahawalnagar->id, 'name' => 'Chishtian', 'code' => 'BNG-CH', 'is_active' => true],
            ['district_id' => $bahawalnagar->id, 'name' => 'Fort Abbas', 'code' => 'BNG-FA', 'is_active' => true],
            ['district_id' => $bahawalnagar->id, 'name' => 'Yazman', 'code' => 'BNG-YZ', 'is_active' => true],

            // Karachi District Tehseels
            ['district_id' => $karachi->id, 'name' => 'Karachi East', 'code' => 'KHI-E', 'is_active' => true],
            ['district_id' => $karachi->id, 'name' => 'Karachi West', 'code' => 'KHI-W', 'is_active' => true],
            ['district_id' => $karachi->id, 'name' => 'Karachi South', 'code' => 'KHI-S', 'is_active' => true],
            ['district_id' => $karachi->id, 'name' => 'Karachi Central', 'code' => 'KHI-C', 'is_active' => true],
            ['district_id' => $karachi->id, 'name' => 'Malir', 'code' => 'KHI-ML', 'is_active' => true],
            ['district_id' => $karachi->id, 'name' => 'Korangi', 'code' => 'KHI-KR', 'is_active' => true],
            ['district_id' => $karachi->id, 'name' => 'Clifton', 'code' => 'KHI-CL', 'is_active' => true],
            ['district_id' => $karachi->id, 'name' => 'Gulshan-e-Iqbal', 'code' => 'KHI-GI', 'is_active' => true],
            ['district_id' => $karachi->id, 'name' => 'North Nazimabad', 'code' => 'KHI-NN', 'is_active' => true],
            ['district_id' => $karachi->id, 'name' => 'Liaquatabad', 'code' => 'KHI-LB', 'is_active' => true],

            // Hyderabad District Tehseels
            ['district_id' => $hyderabad->id, 'name' => 'Hyderabad City', 'code' => 'HYD-CITY', 'is_active' => true],
            ['district_id' => $hyderabad->id, 'name' => 'Hyderabad Cantonment', 'code' => 'HYD-CANT', 'is_active' => true],
            ['district_id' => $hyderabad->id, 'name' => 'Latifabad', 'code' => 'HYD-LB', 'is_active' => true],
            ['district_id' => $hyderabad->id, 'name' => 'Qasimabad', 'code' => 'HYD-QB', 'is_active' => true],
            ['district_id' => $hyderabad->id, 'name' => 'Tando Jam', 'code' => 'HYD-TJ', 'is_active' => true],

            // Sukkur District Tehseels
            ['district_id' => $sukkur->id, 'name' => 'Sukkur City', 'code' => 'SKR-CITY', 'is_active' => true],
            ['district_id' => $sukkur->id, 'name' => 'Sukkur Cantonment', 'code' => 'SKR-CANT', 'is_active' => true],
            ['district_id' => $sukkur->id, 'name' => 'Rohri', 'code' => 'SKR-RH', 'is_active' => true],
            ['district_id' => $sukkur->id, 'name' => 'Pano Akil', 'code' => 'SKR-PA', 'is_active' => true],
            ['district_id' => $sukkur->id, 'name' => 'Saleh Pat', 'code' => 'SKR-SP', 'is_active' => true],

            // Larkana District Tehseels
            ['district_id' => $larkana->id, 'name' => 'Larkana City', 'code' => 'LRK-CITY', 'is_active' => true],
            ['district_id' => $larkana->id, 'name' => 'Larkana Cantonment', 'code' => 'LRK-CANT', 'is_active' => true],
            ['district_id' => $larkana->id, 'name' => 'Rato Dero', 'code' => 'LRK-RD', 'is_active' => true],
            ['district_id' => $larkana->id, 'name' => 'Dokri', 'code' => 'LRK-DK', 'is_active' => true],
            ['district_id' => $larkana->id, 'name' => 'Bakrani', 'code' => 'LRK-BK', 'is_active' => true],

            // Mirpurkhas District Tehseels
            ['district_id' => $mirpurkhas->id, 'name' => 'Mirpurkhas City', 'code' => 'MPK-CITY', 'is_active' => true],
            ['district_id' => $mirpurkhas->id, 'name' => 'Jhudo', 'code' => 'MPK-JD', 'is_active' => true],
            ['district_id' => $mirpurkhas->id, 'name' => 'Sindhri', 'code' => 'MPK-SR', 'is_active' => true],
            ['district_id' => $mirpurkhas->id, 'name' => 'Kot Ghulam Muhammad', 'code' => 'MPK-KG', 'is_active' => true],

            // Nawabshah District Tehseels
            ['district_id' => $nawabshah->id, 'name' => 'Nawabshah City', 'code' => 'NWB-CITY', 'is_active' => true],
            ['district_id' => $nawabshah->id, 'name' => 'Nawabshah Cantonment', 'code' => 'NWB-CANT', 'is_active' => true],
            ['district_id' => $nawabshah->id, 'name' => 'Sakrand', 'code' => 'NWB-SK', 'is_active' => true],
            ['district_id' => $nawabshah->id, 'name' => 'Daulatpur', 'code' => 'NWB-DP', 'is_active' => true],

            // Jacobabad District Tehseels
            ['district_id' => $jacobabad->id, 'name' => 'Jacobabad City', 'code' => 'JCB-CITY', 'is_active' => true],
            ['district_id' => $jacobabad->id, 'name' => 'Jacobabad Cantonment', 'code' => 'JCB-CANT', 'is_active' => true],
            ['district_id' => $jacobabad->id, 'name' => 'Thul', 'code' => 'JCB-TH', 'is_active' => true],
            ['district_id' => $jacobabad->id, 'name' => 'Gari Khero', 'code' => 'JCB-GK', 'is_active' => true],

            // Shikarpur District Tehseels
            ['district_id' => $shikarpur->id, 'name' => 'Shikarpur City', 'code' => 'SKP-CITY', 'is_active' => true],
            ['district_id' => $shikarpur->id, 'name' => 'Lakhi', 'code' => 'SKP-LK', 'is_active' => true],
            ['district_id' => $shikarpur->id, 'name' => 'Khanpur', 'code' => 'SKP-KP', 'is_active' => true],
            ['district_id' => $shikarpur->id, 'name' => 'Garhi Yasin', 'code' => 'SKP-GY', 'is_active' => true],

            // Khairpur District Tehseels
            ['district_id' => $khairpur->id, 'name' => 'Khairpur City', 'code' => 'KRP-CITY', 'is_active' => true],
            ['district_id' => $khairpur->id, 'name' => 'Khairpur Mirs', 'code' => 'KRP-KM', 'is_active' => true],
            ['district_id' => $khairpur->id, 'name' => 'Kot Diji', 'code' => 'KRP-KD', 'is_active' => true],
            ['district_id' => $khairpur->id, 'name' => 'Tando Masti Khan', 'code' => 'KRP-TM', 'is_active' => true],

            // Dadu District Tehseels
            ['district_id' => $dadu->id, 'name' => 'Dadu City', 'code' => 'DAD-CITY', 'is_active' => true],
            ['district_id' => $dadu->id, 'name' => 'Meher', 'code' => 'DAD-MH', 'is_active' => true],
            ['district_id' => $dadu->id, 'name' => 'Johi', 'code' => 'DAD-JH', 'is_active' => true],
            ['district_id' => $dadu->id, 'name' => 'Sehwan', 'code' => 'DAD-SW', 'is_active' => true],

            // Badin District Tehseels
            ['district_id' => $badin->id, 'name' => 'Badin City', 'code' => 'BDN-CITY', 'is_active' => true],
            ['district_id' => $badin->id, 'name' => 'Matli', 'code' => 'BDN-MT', 'is_active' => true],
            ['district_id' => $badin->id, 'name' => 'Tando Bago', 'code' => 'BDN-TB', 'is_active' => true],
            ['district_id' => $badin->id, 'name' => 'Golarchi', 'code' => 'BDN-GC', 'is_active' => true],

            // Thatta District Tehseels
            ['district_id' => $thatta->id, 'name' => 'Thatta City', 'code' => 'THA-CITY', 'is_active' => true],
            ['district_id' => $thatta->id, 'name' => 'Sujawal', 'code' => 'THA-SJ', 'is_active' => true],
            ['district_id' => $thatta->id, 'name' => 'Mirpur Bathoro', 'code' => 'THA-MB', 'is_active' => true],
            ['district_id' => $thatta->id, 'name' => 'Keti Bunder', 'code' => 'THA-KB', 'is_active' => true],

            // Sanghar District Tehseels
            ['district_id' => $sanghar->id, 'name' => 'Sanghar City', 'code' => 'SGR-CITY', 'is_active' => true],
            ['district_id' => $sanghar->id, 'name' => 'Tando Adam', 'code' => 'SGR-TA', 'is_active' => true],
            ['district_id' => $sanghar->id, 'name' => 'Shahdadpur', 'code' => 'SGR-SD', 'is_active' => true],
            ['district_id' => $sanghar->id, 'name' => 'Khipro', 'code' => 'SGR-KP', 'is_active' => true],

            // Naushahro Feroze District Tehseels
            ['district_id' => $naushahro_feroze->id, 'name' => 'Naushahro Feroze City', 'code' => 'NSF-CITY', 'is_active' => true],
            ['district_id' => $naushahro_feroze->id, 'name' => 'Kandiaro', 'code' => 'NSF-KD', 'is_active' => true],
            ['district_id' => $naushahro_feroze->id, 'name' => 'Moro', 'code' => 'NSF-MR', 'is_active' => true],
            ['district_id' => $naushahro_feroze->id, 'name' => 'Bhiria', 'code' => 'NSF-BH', 'is_active' => true],

            // Tando Muhammad Khan District Tehseels
            ['district_id' => $tando_muhammad_khan->id, 'name' => 'Tando Muhammad Khan City', 'code' => 'TMK-CITY', 'is_active' => true],
            ['district_id' => $tando_muhammad_khan->id, 'name' => 'Bulri Shah Karim', 'code' => 'TMK-BS', 'is_active' => true],
            ['district_id' => $tando_muhammad_khan->id, 'name' => 'Tando Ghulam Hyder', 'code' => 'TMK-TG', 'is_active' => true],

            // Tando Allahyar District Tehseels
            ['district_id' => $tando_allahyar->id, 'name' => 'Tando Allahyar City', 'code' => 'TAY-CITY', 'is_active' => true],
            ['district_id' => $tando_allahyar->id, 'name' => 'Chamber', 'code' => 'TAY-CH', 'is_active' => true],
            ['district_id' => $tando_allahyar->id, 'name' => 'Jhudo', 'code' => 'TAY-JD', 'is_active' => true],

            // Matliari District Tehseels
            ['district_id' => $matliari->id, 'name' => 'Matliari City', 'code' => 'MTL-CITY', 'is_active' => true],
            ['district_id' => $matliari->id, 'name' => 'Hala', 'code' => 'MTL-HL', 'is_active' => true],
            ['district_id' => $matliari->id, 'name' => 'Saeedabad', 'code' => 'MTL-SB', 'is_active' => true],

            // Umerkot District Tehseels
            ['district_id' => $umerkot->id, 'name' => 'Umerkot City', 'code' => 'UMK-CITY', 'is_active' => true],
            ['district_id' => $umerkot->id, 'name' => 'Kunri', 'code' => 'UMK-KN', 'is_active' => true],
            ['district_id' => $umerkot->id, 'name' => 'Samaro', 'code' => 'UMK-SM', 'is_active' => true],
            ['district_id' => $umerkot->id, 'name' => 'Pithoro', 'code' => 'UMK-PT', 'is_active' => true],

            // Jamshoro District Tehseels
            ['district_id' => $jamshoro->id, 'name' => 'Jamshoro City', 'code' => 'JSH-CITY', 'is_active' => true],
            ['district_id' => $jamshoro->id, 'name' => 'Kotri', 'code' => 'JSH-KT', 'is_active' => true],
            ['district_id' => $jamshoro->id, 'name' => 'Manjhand', 'code' => 'JSH-MJ', 'is_active' => true],

            // Kashmore District Tehseels
            ['district_id' => $kashmore->id, 'name' => 'Kashmore City', 'code' => 'KSM-CITY', 'is_active' => true],
            ['district_id' => $kashmore->id, 'name' => 'Kandhkot', 'code' => 'KSM-KK', 'is_active' => true],
            ['district_id' => $kashmore->id, 'name' => 'Tangwani', 'code' => 'KSM-TW', 'is_active' => true],

            // Qambar Shahdadkot District Tehseels
            ['district_id' => $qambar_shahdadkot->id, 'name' => 'Qambar City', 'code' => 'QSK-CITY', 'is_active' => true],
            ['district_id' => $qambar_shahdadkot->id, 'name' => 'Shahdadkot', 'code' => 'QSK-SD', 'is_active' => true],
            ['district_id' => $qambar_shahdadkot->id, 'name' => 'Warah', 'code' => 'QSK-WR', 'is_active' => true],

            // Ghotki District Tehseels
            ['district_id' => $ghotki->id, 'name' => 'Ghotki City', 'code' => 'GTK-CITY', 'is_active' => true],
            ['district_id' => $ghotki->id, 'name' => 'Mirpur Mathelo', 'code' => 'GTK-MM', 'is_active' => true],
            ['district_id' => $ghotki->id, 'name' => 'Daharki', 'code' => 'GTK-DK', 'is_active' => true],
            ['district_id' => $ghotki->id, 'name' => 'Ubauro', 'code' => 'GTK-UB', 'is_active' => true],

            // Shaheed Benazirabad District Tehseels
            ['district_id' => $shaheed_benazirabad->id, 'name' => 'Shaheed Benazirabad City', 'code' => 'SBA-CITY', 'is_active' => true],
            ['district_id' => $shaheed_benazirabad->id, 'name' => 'Daur', 'code' => 'SBA-DR', 'is_active' => true],
            ['district_id' => $shaheed_benazirabad->id, 'name' => 'Sakrand', 'code' => 'SBA-SK', 'is_active' => true],

            // Matiari District Tehseels
            ['district_id' => $matiari->id, 'name' => 'Matiari City', 'code' => 'MTR-CITY', 'is_active' => true],
            ['district_id' => $matiari->id, 'name' => 'Hala', 'code' => 'MTR-HL', 'is_active' => true],
            ['district_id' => $matiari->id, 'name' => 'Saeedabad', 'code' => 'MTR-SB', 'is_active' => true],

            // Sujawal District Tehseels
            ['district_id' => $sujawal->id, 'name' => 'Sujawal City', 'code' => 'SJW-CITY', 'is_active' => true],
            ['district_id' => $sujawal->id, 'name' => 'Jati', 'code' => 'SJW-JT', 'is_active' => true],
            ['district_id' => $sujawal->id, 'name' => 'Kharo Chan', 'code' => 'SJW-KC', 'is_active' => true],

            // Peshawar District Tehseels
            ['district_id' => $peshawar->id, 'name' => 'Peshawar City', 'code' => 'PSW-CITY', 'is_active' => true],
            ['district_id' => $peshawar->id, 'name' => 'Peshawar Cantonment', 'code' => 'PSW-CANT', 'is_active' => true],
            ['district_id' => $peshawar->id, 'name' => 'Hayatabad', 'code' => 'PSW-HB', 'is_active' => true],
            ['district_id' => $peshawar->id, 'name' => 'University Town', 'code' => 'PSW-UT', 'is_active' => true],
            ['district_id' => $peshawar->id, 'name' => 'Tehkal', 'code' => 'PSW-TK', 'is_active' => true],
            ['district_id' => $peshawar->id, 'name' => 'Badaber', 'code' => 'PSW-BD', 'is_active' => true],

            // Mardan District Tehseels
            ['district_id' => $mardan->id, 'name' => 'Mardan City', 'code' => 'MRD-CITY', 'is_active' => true],
            ['district_id' => $mardan->id, 'name' => 'Mardan Cantonment', 'code' => 'MRD-CANT', 'is_active' => true],
            ['district_id' => $mardan->id, 'name' => 'Takht Bhai', 'code' => 'MRD-TB', 'is_active' => true],
            ['district_id' => $mardan->id, 'name' => 'Swabi Road', 'code' => 'MRD-SR', 'is_active' => true],
            ['district_id' => $mardan->id, 'name' => 'Katlang', 'code' => 'MRD-KL', 'is_active' => true],

            // Swabi District Tehseels
            ['district_id' => $swabi->id, 'name' => 'Swabi City', 'code' => 'SWB-CITY', 'is_active' => true],
            ['district_id' => $swabi->id, 'name' => 'Topi', 'code' => 'SWB-TP', 'is_active' => true],
            ['district_id' => $swabi->id, 'name' => 'Lahor', 'code' => 'SWB-LH', 'is_active' => true],
            ['district_id' => $swabi->id, 'name' => 'Razar', 'code' => 'SWB-RZ', 'is_active' => true],
            ['district_id' => $swabi->id, 'name' => 'Zaida', 'code' => 'SWB-ZD', 'is_active' => true],

            // Nowshera District Tehseels
            ['district_id' => $nowshera->id, 'name' => 'Nowshera City', 'code' => 'NSR-CITY', 'is_active' => true],
            ['district_id' => $nowshera->id, 'name' => 'Nowshera Cantonment', 'code' => 'NSR-CANT', 'is_active' => true],
            ['district_id' => $nowshera->id, 'name' => 'Jahangira', 'code' => 'NSR-JG', 'is_active' => true],
            ['district_id' => $nowshera->id, 'name' => 'Pabbi', 'code' => 'NSR-PB', 'is_active' => true],
            ['district_id' => $nowshera->id, 'name' => 'Akora Khattak', 'code' => 'NSR-AK', 'is_active' => true],

            // Charsadda District Tehseels
            ['district_id' => $charsadda->id, 'name' => 'Charsadda City', 'code' => 'CSD-CITY', 'is_active' => true],
            ['district_id' => $charsadda->id, 'name' => 'Tangi', 'code' => 'CSD-TG', 'is_active' => true],
            ['district_id' => $charsadda->id, 'name' => 'Shabqadar', 'code' => 'CSD-SB', 'is_active' => true],
            ['district_id' => $charsadda->id, 'name' => 'Utmanzai', 'code' => 'CSD-UT', 'is_active' => true],

            // Kohat District Tehseels
            ['district_id' => $kohat->id, 'name' => 'Kohat City', 'code' => 'KHT-CITY', 'is_active' => true],
            ['district_id' => $kohat->id, 'name' => 'Kohat Cantonment', 'code' => 'KHT-CANT', 'is_active' => true],
            ['district_id' => $kohat->id, 'name' => 'Lachi', 'code' => 'KHT-LC', 'is_active' => true],
            ['district_id' => $kohat->id, 'name' => 'Gumbat', 'code' => 'KHT-GB', 'is_active' => true],
            ['district_id' => $kohat->id, 'name' => 'Hangu', 'code' => 'KHT-HG', 'is_active' => true],

            // Dera Ismail Khan District Tehseels
            ['district_id' => $dera_ismail_khan->id, 'name' => 'Dera Ismail Khan City', 'code' => 'DIK-CITY', 'is_active' => true],
            ['district_id' => $dera_ismail_khan->id, 'name' => 'Dera Ismail Khan Cantonment', 'code' => 'DIK-CANT', 'is_active' => true],
            ['district_id' => $dera_ismail_khan->id, 'name' => 'Paharpur', 'code' => 'DIK-PP', 'is_active' => true],
            ['district_id' => $dera_ismail_khan->id, 'name' => 'Kulachi', 'code' => 'DIK-KL', 'is_active' => true],
            ['district_id' => $dera_ismail_khan->id, 'name' => 'Darazinda', 'code' => 'DIK-DZ', 'is_active' => true],

            // Bannu District Tehseels
            ['district_id' => $bannu->id, 'name' => 'Bannu City', 'code' => 'BNU-CITY', 'is_active' => true],
            ['district_id' => $bannu->id, 'name' => 'Bannu Cantonment', 'code' => 'BNU-CANT', 'is_active' => true],
            ['district_id' => $bannu->id, 'name' => 'Kakki', 'code' => 'BNU-KK', 'is_active' => true],
            ['district_id' => $bannu->id, 'name' => 'Domail', 'code' => 'BNU-DM', 'is_active' => true],
            ['district_id' => $bannu->id, 'name' => 'Janikhel', 'code' => 'BNU-JK', 'is_active' => true],

            // Swat District Tehseels
            ['district_id' => $swat->id, 'name' => 'Mingora', 'code' => 'SWT-MG', 'is_active' => true],
            ['district_id' => $swat->id, 'name' => 'Saidu Sharif', 'code' => 'SWT-SS', 'is_active' => true],
            ['district_id' => $swat->id, 'name' => 'Kabal', 'code' => 'SWT-KB', 'is_active' => true],
            ['district_id' => $swat->id, 'name' => 'Matta', 'code' => 'SWT-MT', 'is_active' => true],
            ['district_id' => $swat->id, 'name' => 'Bahrain', 'code' => 'SWT-BH', 'is_active' => true],
            ['district_id' => $swat->id, 'name' => 'Kalam', 'code' => 'SWT-KL', 'is_active' => true],

            // Malakand District Tehseels
            ['district_id' => $malakand->id, 'name' => 'Batkhela', 'code' => 'MLK-BT', 'is_active' => true],
            ['district_id' => $malakand->id, 'name' => 'Dargai', 'code' => 'MLK-DG', 'is_active' => true],
            ['district_id' => $malakand->id, 'name' => 'Sakhakot', 'code' => 'MLK-SK', 'is_active' => true],
            ['district_id' => $malakand->id, 'name' => 'Thana', 'code' => 'MLK-TH', 'is_active' => true],

            // Lower Dir District Tehseels
            ['district_id' => $lower_dir->id, 'name' => 'Timergara', 'code' => 'LDR-TM', 'is_active' => true],
            ['district_id' => $lower_dir->id, 'name' => 'Samar Bagh', 'code' => 'LDR-SB', 'is_active' => true],
            ['district_id' => $lower_dir->id, 'name' => 'Munda', 'code' => 'LDR-MD', 'is_active' => true],
            ['district_id' => $lower_dir->id, 'name' => 'Chakdara', 'code' => 'LDR-CD', 'is_active' => true],
            ['district_id' => $lower_dir->id, 'name' => 'Asbanr', 'code' => 'LDR-AS', 'is_active' => true],

            // Upper Dir District Tehseels
            ['district_id' => $upper_dir->id, 'name' => 'Dir City', 'code' => 'UDR-CITY', 'is_active' => true],
            ['district_id' => $upper_dir->id, 'name' => 'Wari', 'code' => 'UDR-WR', 'is_active' => true],
            ['district_id' => $upper_dir->id, 'name' => 'Barawal', 'code' => 'UDR-BW', 'is_active' => true],
            ['district_id' => $upper_dir->id, 'name' => 'Kotkai', 'code' => 'UDR-KK', 'is_active' => true],
            ['district_id' => $upper_dir->id, 'name' => 'Patan', 'code' => 'UDR-PT', 'is_active' => true],

            // Chitral District Tehseels
            ['district_id' => $chitral->id, 'name' => 'Chitral City', 'code' => 'CTR-CITY', 'is_active' => true],
            ['district_id' => $chitral->id, 'name' => 'Drosh', 'code' => 'CTR-DR', 'is_active' => true],
            ['district_id' => $chitral->id, 'name' => 'Booni', 'code' => 'CTR-BN', 'is_active' => true],
            ['district_id' => $chitral->id, 'name' => 'Garam Chashma', 'code' => 'CTR-GC', 'is_active' => true],
            ['district_id' => $chitral->id, 'name' => 'Mastuj', 'code' => 'CTR-MJ', 'is_active' => true],

            // Shangla District Tehseels
            ['district_id' => $shangla->id, 'name' => 'Alpuri', 'code' => 'SGL-AP', 'is_active' => true],
            ['district_id' => $shangla->id, 'name' => 'Besham', 'code' => 'SGL-BS', 'is_active' => true],
            ['district_id' => $shangla->id, 'name' => 'Purana', 'code' => 'SGL-PR', 'is_active' => true],
            ['district_id' => $shangla->id, 'name' => 'Chakesar', 'code' => 'SGL-CK', 'is_active' => true],

            // Buner District Tehseels
            ['district_id' => $buner->id, 'name' => 'Daggar', 'code' => 'BNR-DG', 'is_active' => true],
            ['district_id' => $buner->id, 'name' => 'Gagra', 'code' => 'BNR-GG', 'is_active' => true],
            ['district_id' => $buner->id, 'name' => 'Pir Baba', 'code' => 'BNR-PB', 'is_active' => true],
            ['district_id' => $buner->id, 'name' => 'Totalai', 'code' => 'BNR-TL', 'is_active' => true],

            // Haripur District Tehseels
            ['district_id' => $haripur->id, 'name' => 'Haripur City', 'code' => 'HRP-CITY', 'is_active' => true],
            ['district_id' => $haripur->id, 'name' => 'Khalabat', 'code' => 'HRP-KB', 'is_active' => true],
            ['district_id' => $haripur->id, 'name' => 'Sirkot', 'code' => 'HRP-SK', 'is_active' => true],
            ['district_id' => $haripur->id, 'name' => 'Khanpur', 'code' => 'HRP-KP', 'is_active' => true],

            // Mansehra District Tehseels
            ['district_id' => $mansehra->id, 'name' => 'Mansehra City', 'code' => 'MNS-CITY', 'is_active' => true],
            ['district_id' => $mansehra->id, 'name' => 'Baffa', 'code' => 'MNS-BF', 'is_active' => true],
            ['district_id' => $mansehra->id, 'name' => 'Oghi', 'code' => 'MNS-OG', 'is_active' => true],
            ['district_id' => $mansehra->id, 'name' => 'Darband', 'code' => 'MNS-DB', 'is_active' => true],
            ['district_id' => $mansehra->id, 'name' => 'Shinkiari', 'code' => 'MNS-SK', 'is_active' => true],

            // Abbottabad District Tehseels
            ['district_id' => $abbottabad->id, 'name' => 'Abbottabad City', 'code' => 'ABT-CITY', 'is_active' => true],
            ['district_id' => $abbottabad->id, 'name' => 'Abbottabad Cantonment', 'code' => 'ABT-CANT', 'is_active' => true],
            ['district_id' => $abbottabad->id, 'name' => 'Nawanshehr', 'code' => 'ABT-NS', 'is_active' => true],
            ['district_id' => $abbottabad->id, 'name' => 'Havelian', 'code' => 'ABT-HV', 'is_active' => true],
            ['district_id' => $abbottabad->id, 'name' => 'Qalandarabad', 'code' => 'ABT-QB', 'is_active' => true],
            ['district_id' => $abbottabad->id, 'name' => 'Sherwan', 'code' => 'ABT-SW', 'is_active' => true],

            // Batagram District Tehseels
            ['district_id' => $batagram->id, 'name' => 'Batagram City', 'code' => 'BTG-CITY', 'is_active' => true],
            ['district_id' => $batagram->id, 'name' => 'Allai', 'code' => 'BTG-AL', 'is_active' => true],
            ['district_id' => $batagram->id, 'name' => 'Benshahi', 'code' => 'BTG-BS', 'is_active' => true],
            ['district_id' => $batagram->id, 'name' => 'Pattan', 'code' => 'BTG-PT', 'is_active' => true],

            // Kohistan District Tehseels
            ['district_id' => $kohistan->id, 'name' => 'Dasu', 'code' => 'KST-DS', 'is_active' => true],
            ['district_id' => $kohistan->id, 'name' => 'Pattan', 'code' => 'KST-PT', 'is_active' => true],
            ['district_id' => $kohistan->id, 'name' => 'Besham', 'code' => 'KST-BS', 'is_active' => true],
            ['district_id' => $kohistan->id, 'name' => 'Dubair', 'code' => 'KST-DB', 'is_active' => true],

            // Torghar District Tehseels
            ['district_id' => $torghar->id, 'name' => 'Judba', 'code' => 'TGH-JD', 'is_active' => true],
            ['district_id' => $torghar->id, 'name' => 'Kandao', 'code' => 'TGH-KD', 'is_active' => true],
            ['district_id' => $torghar->id, 'name' => 'Lal Qila', 'code' => 'TGH-LQ', 'is_active' => true],

            // Tank District Tehseels
            ['district_id' => $tank->id, 'name' => 'Tank City', 'code' => 'TNK-CITY', 'is_active' => true],
            ['district_id' => $tank->id, 'name' => 'Jandola', 'code' => 'TNK-JD', 'is_active' => true],
            ['district_id' => $tank->id, 'name' => 'Gomal Zam', 'code' => 'TNK-GZ', 'is_active' => true],

            // Lakki Marwat District Tehseels
            ['district_id' => $lakki_marwat->id, 'name' => 'Lakki City', 'code' => 'LKM-CITY', 'is_active' => true],
            ['district_id' => $lakki_marwat->id, 'name' => 'Tajori', 'code' => 'LKM-TJ', 'is_active' => true],
            ['district_id' => $lakki_marwat->id, 'name' => 'Naurang', 'code' => 'LKM-NR', 'is_active' => true],
            ['district_id' => $lakki_marwat->id, 'name' => 'Seri Bakhmal', 'code' => 'LKM-SB', 'is_active' => true],

            // Karak District Tehseels
            ['district_id' => $karak->id, 'name' => 'Karak City', 'code' => 'KRK-CITY', 'is_active' => true],
            ['district_id' => $karak->id, 'name' => 'Bannu', 'code' => 'KRK-BN', 'is_active' => true],
            ['district_id' => $karak->id, 'name' => 'Takht-e-Nasrati', 'code' => 'KRK-TN', 'is_active' => true],
            ['district_id' => $karak->id, 'name' => 'Latamber', 'code' => 'KRK-LT', 'is_active' => true],

            // Hangu District Tehseels
            ['district_id' => $hangu->id, 'name' => 'Hangu City', 'code' => 'HNG-CITY', 'is_active' => true],
            ['district_id' => $hangu->id, 'name' => 'Talli', 'code' => 'HNG-TL', 'is_active' => true],
            ['district_id' => $hangu->id, 'name' => 'Doaba', 'code' => 'HNG-DB', 'is_active' => true],
            ['district_id' => $hangu->id, 'name' => 'Karak', 'code' => 'HNG-KR', 'is_active' => true],

            // Quetta District Tehseels
            ['district_id' => $quetta->id, 'name' => 'Quetta City', 'code' => 'QTA-CITY', 'is_active' => true],
            ['district_id' => $quetta->id, 'name' => 'Quetta Cantonment', 'code' => 'QTA-CANT', 'is_active' => true],
            ['district_id' => $quetta->id, 'name' => 'Sariab', 'code' => 'QTA-SR', 'is_active' => true],
            ['district_id' => $quetta->id, 'name' => 'Kuchlak', 'code' => 'QTA-KC', 'is_active' => true],
            ['district_id' => $quetta->id, 'name' => 'Spin Karez', 'code' => 'QTA-SK', 'is_active' => true],
            ['district_id' => $quetta->id, 'name' => 'Hazara Town', 'code' => 'QTA-HT', 'is_active' => true],

            // Gwadar District Tehseels
            ['district_id' => $gwadar->id, 'name' => 'Gwadar City', 'code' => 'GWD-CITY', 'is_active' => true],
            ['district_id' => $gwadar->id, 'name' => 'Jiwani', 'code' => 'GWD-JW', 'is_active' => true],
            ['district_id' => $gwadar->id, 'name' => 'Pasni', 'code' => 'GWD-PS', 'is_active' => true],
            ['district_id' => $gwadar->id, 'name' => 'Ormara', 'code' => 'GWD-OM', 'is_active' => true],

            // Turbat District Tehseels
            ['district_id' => $turbat->id, 'name' => 'Turbat City', 'code' => 'TRB-CITY', 'is_active' => true],
            ['district_id' => $turbat->id, 'name' => 'Mand', 'code' => 'TRB-MD', 'is_active' => true],
            ['district_id' => $turbat->id, 'name' => 'Tump', 'code' => 'TRB-TP', 'is_active' => true],
            ['district_id' => $turbat->id, 'name' => 'Buleda', 'code' => 'TRB-BL', 'is_active' => true],

            // Sibi District Tehseels
            ['district_id' => $sibi->id, 'name' => 'Sibi City', 'code' => 'SBI-CITY', 'is_active' => true],
            ['district_id' => $sibi->id, 'name' => 'Sibi Cantonment', 'code' => 'SBI-CANT', 'is_active' => true],
            ['district_id' => $sibi->id, 'name' => 'Harnai', 'code' => 'SBI-HN', 'is_active' => true],
            ['district_id' => $sibi->id, 'name' => 'Kot Rais', 'code' => 'SBI-KR', 'is_active' => true],

            // Loralai District Tehseels
            ['district_id' => $loralai->id, 'name' => 'Loralai City', 'code' => 'LRL-CITY', 'is_active' => true],
            ['district_id' => $loralai->id, 'name' => 'Loralai Cantonment', 'code' => 'LRL-CANT', 'is_active' => true],
            ['district_id' => $loralai->id, 'name' => 'Duki', 'code' => 'LRL-DK', 'is_active' => true],
            ['district_id' => $loralai->id, 'name' => 'Bori', 'code' => 'LRL-BR', 'is_active' => true],

            // Zhob District Tehseels
            ['district_id' => $zhob->id, 'name' => 'Zhob City', 'code' => 'ZHB-CITY', 'is_active' => true],
            ['district_id' => $zhob->id, 'name' => 'Zhob Cantonment', 'code' => 'ZHB-CANT', 'is_active' => true],
            ['district_id' => $zhob->id, 'name' => 'Qamar Din Karez', 'code' => 'ZHB-QK', 'is_active' => true],
            ['district_id' => $zhob->id, 'name' => 'Kakar Khur', 'code' => 'ZHB-KK', 'is_active' => true],
            ['district_id' => $zhob->id, 'name' => 'Sherani', 'code' => 'ZHB-SR', 'is_active' => true],

            // Lasbela District Tehseels
            ['district_id' => $lasbela->id, 'name' => 'Belaa City', 'code' => 'LSB-CITY', 'is_active' => true],
            ['district_id' => $lasbela->id, 'name' => 'Uthal', 'code' => 'LSB-UT', 'is_active' => true],
            ['district_id' => $lasbela->id, 'name' => 'Hub', 'code' => 'LSB-HB', 'is_active' => true],
            ['district_id' => $lasbela->id, 'name' => 'Sonmiani', 'code' => 'LSB-SM', 'is_active' => true],

            // Khuzdar District Tehseels
            ['district_id' => $khuzdar->id, 'name' => 'Khuzdar City', 'code' => 'KZD-CITY', 'is_active' => true],
            ['district_id' => $khuzdar->id, 'name' => 'Khuzdar Cantonment', 'code' => 'KZD-CANT', 'is_active' => true],
            ['district_id' => $khuzdar->id, 'name' => 'Wadh', 'code' => 'KZD-WD', 'is_active' => true],
            ['district_id' => $khuzdar->id, 'name' => 'Jhal Magsi', 'code' => 'KZD-JM', 'is_active' => true],
            ['district_id' => $khuzdar->id, 'name' => 'Mula', 'code' => 'KZD-ML', 'is_active' => true],

            // Jafarabad District Tehseels
            ['district_id' => $jafarabad->id, 'name' => 'Dera Allah Yar', 'code' => 'JFD-DY', 'is_active' => true],
            ['district_id' => $jafarabad->id, 'name' => 'Usta Mohammad', 'code' => 'JFD-UM', 'is_active' => true],
            ['district_id' => $jafarabad->id, 'name' => 'Bel Pat', 'code' => 'JFD-BP', 'is_active' => true],
            ['district_id' => $jafarabad->id, 'name' => 'Gandakha', 'code' => 'JFD-GK', 'is_active' => true],

            // Jhal Magsi District Tehseels
            ['district_id' => $jhal_magsi->id, 'name' => 'Jhal Magsi City', 'code' => 'JMG-CITY', 'is_active' => true],
            ['district_id' => $jhal_magsi->id, 'name' => 'Gandava', 'code' => 'JMG-GD', 'is_active' => true],
            ['district_id' => $jhal_magsi->id, 'name' => 'Mirpur', 'code' => 'JMG-MP', 'is_active' => true],
            ['district_id' => $jhal_magsi->id, 'name' => 'Safa', 'code' => 'JMG-SF', 'is_active' => true],

            // Kachhi District Tehseels
            ['district_id' => $kachhi->id, 'name' => 'Bhag', 'code' => 'KCH-BH', 'is_active' => true],
            ['district_id' => $kachhi->id, 'name' => 'Dhadar', 'code' => 'KCH-DD', 'is_active' => true],
            ['district_id' => $kachhi->id, 'name' => 'Sani', 'code' => 'KCH-SN', 'is_active' => true],
            ['district_id' => $kachhi->id, 'name' => 'Kirthar', 'code' => 'KCH-KT', 'is_active' => true],

            // Sohbatpur District Tehseels
            ['district_id' => $sohbatpur->id, 'name' => 'Sohbatpur City', 'code' => 'SBP-CITY', 'is_active' => true],
            ['district_id' => $sohbatpur->id, 'name' => 'Hai', 'code' => 'SBP-HI', 'is_active' => true],
            ['district_id' => $sohbatpur->id, 'name' => 'Faridabad', 'code' => 'SBP-FD', 'is_active' => true],

            // Nasirabad District Tehseels
            ['district_id' => $nasirabad->id, 'name' => 'Dera Murad Jamali', 'code' => 'NSB-DM', 'is_active' => true],
            ['district_id' => $nasirabad->id, 'name' => 'Tamboo', 'code' => 'NSB-TB', 'is_active' => true],
            ['district_id' => $nasirabad->id, 'name' => 'Bela', 'code' => 'NSB-BL', 'is_active' => true],
            ['district_id' => $nasirabad->id, 'name' => 'Chattar', 'code' => 'NSB-CT', 'is_active' => true],

            // Bolan District Tehseels
            ['district_id' => $bolan->id, 'name' => 'Mach', 'code' => 'BLN-MC', 'is_active' => true],
            ['district_id' => $bolan->id, 'name' => 'Sanni', 'code' => 'BLN-SN', 'is_active' => true],
            ['district_id' => $bolan->id, 'name' => 'Dhadar', 'code' => 'BLN-DD', 'is_active' => true],
            ['district_id' => $bolan->id, 'name' => 'Bhag', 'code' => 'BLN-BH', 'is_active' => true],

            // Mastung District Tehseels
            ['district_id' => $mastung->id, 'name' => 'Mastung City', 'code' => 'MTG-CITY', 'is_active' => true],
            ['district_id' => $mastung->id, 'name' => 'Kardigap', 'code' => 'MTG-KD', 'is_active' => true],
            ['district_id' => $mastung->id, 'name' => 'Karez', 'code' => 'MTG-KZ', 'is_active' => true],
            ['district_id' => $mastung->id, 'name' => 'Sultanabad', 'code' => 'MTG-ST', 'is_active' => true],

            // Kalat District Tehseels
            ['district_id' => $kalat->id, 'name' => 'Kalat City', 'code' => 'KLT-CITY', 'is_active' => true],
            ['district_id' => $kalat->id, 'name' => 'Kalat Cantonment', 'code' => 'KLT-CANT', 'is_active' => true],
            ['district_id' => $kalat->id, 'name' => 'Surab', 'code' => 'KLT-SR', 'is_active' => true],
            ['district_id' => $kalat->id, 'name' => 'Mangochar', 'code' => 'KLT-MC', 'is_active' => true],
            ['district_id' => $kalat->id, 'name' => 'Gandava', 'code' => 'KLT-GD', 'is_active' => true],

            // Kharan District Tehseels
            ['district_id' => $kharan->id, 'name' => 'Kharan City', 'code' => 'KRN-CITY', 'is_active' => true],
            ['district_id' => $kharan->id, 'name' => 'Kharan Cantonment', 'code' => 'KRN-CANT', 'is_active' => true],
            ['district_id' => $kharan->id, 'name' => 'Sarawan', 'code' => 'KRN-SW', 'is_active' => true],
            ['district_id' => $kharan->id, 'name' => 'Rakhshan', 'code' => 'KRN-RA', 'is_active' => true],

            // Washuk District Tehseels
            ['district_id' => $washuk->id, 'name' => 'Washuk City', 'code' => 'WSK-CITY', 'is_active' => true],
            ['district_id' => $washuk->id, 'name' => 'Basima', 'code' => 'WSK-BS', 'is_active' => true],
            ['district_id' => $washuk->id, 'name' => 'Mashkel', 'code' => 'WSK-MK', 'is_active' => true],
            ['district_id' => $washuk->id, 'name' => 'Nag', 'code' => 'WSK-NG', 'is_active' => true],

            // Chagai District Tehseels
            ['district_id' => $chagai->id, 'name' => 'Dalbandin', 'code' => 'CGI-DB', 'is_active' => true],
            ['district_id' => $chagai->id, 'name' => 'Nokkundi', 'code' => 'CGI-NK', 'is_active' => true],
            ['district_id' => $chagai->id, 'name' => 'Taftan', 'code' => 'CGI-TT', 'is_active' => true],
            ['district_id' => $chagai->id, 'name' => 'Chagai', 'code' => 'CGI-CG', 'is_active' => true],

            // Nushki District Tehseels
            ['district_id' => $nushki->id, 'name' => 'Nushki City', 'code' => 'NSK-CITY', 'is_active' => true],
            ['district_id' => $nushki->id, 'name' => 'Nushki Cantonment', 'code' => 'NSK-CANT', 'is_active' => true],
            ['district_id' => $nushki->id, 'name' => 'Dalbandin', 'code' => 'NSK-DB', 'is_active' => true],
            ['district_id' => $nushki->id, 'name' => 'Zehri', 'code' => 'NSK-ZR', 'is_active' => true],

            // Dalbandin District Tehseels
            ['district_id' => $dalbandin->id, 'name' => 'Dalbandin City', 'code' => 'DBD-CITY', 'is_active' => true],
            ['district_id' => $dalbandin->id, 'name' => 'Nokkundi', 'code' => 'DBD-NK', 'is_active' => true],
            ['district_id' => $dalbandin->id, 'name' => 'Taftan', 'code' => 'DBD-TT', 'is_active' => true],

            // Panjgur District Tehseels
            ['district_id' => $panjgur->id, 'name' => 'Panjgur City', 'code' => 'PJG-CITY', 'is_active' => true],
            ['district_id' => $panjgur->id, 'name' => 'Panjgur Cantonment', 'code' => 'PJG-CANT', 'is_active' => true],
            ['district_id' => $panjgur->id, 'name' => 'Gishkaur', 'code' => 'PJG-GS', 'is_active' => true],
            ['district_id' => $panjgur->id, 'name' => 'Tump', 'code' => 'PJG-TP', 'is_active' => true],

            // Kech District Tehseels
            ['district_id' => $kech->id, 'name' => 'Turbat City', 'code' => 'KCH-CITY', 'is_active' => true],
            ['district_id' => $kech->id, 'name' => 'Mand', 'code' => 'KCH-MD', 'is_active' => true],
            ['district_id' => $kech->id, 'name' => 'Buleda', 'code' => 'KCH-BL', 'is_active' => true],
            ['district_id' => $kech->id, 'name' => 'Dasht', 'code' => 'KCH-DT', 'is_active' => true],
            ['district_id' => $kech->id, 'name' => 'Tump', 'code' => 'KCH-TP', 'is_active' => true],

            // Awaran District Tehseels
            ['district_id' => $awaran->id, 'name' => 'Awaran City', 'code' => 'AWN-CITY', 'is_active' => true],
            ['district_id' => $awaran->id, 'name' => 'Jhal Jao', 'code' => 'AWN-JJ', 'is_active' => true],
            ['district_id' => $awaran->id, 'name' => 'Gishkaur', 'code' => 'AWN-GS', 'is_active' => true],
            ['district_id' => $awaran->id, 'name' => 'Nag', 'code' => 'AWN-NG', 'is_active' => true],

            // Ziarat District Tehseels
            ['district_id' => $ziarat->id, 'name' => 'Ziarat City', 'code' => 'ZRT-CITY', 'is_active' => true],
            ['district_id' => $ziarat->id, 'name' => 'Karez', 'code' => 'ZRT-KZ', 'is_active' => true],
            ['district_id' => $ziarat->id, 'name' => 'Sanjavi', 'code' => 'ZRT-SJ', 'is_active' => true],
            ['district_id' => $ziarat->id, 'name' => 'Baba Khel', 'code' => 'ZRT-BK', 'is_active' => true],

            // Pishin District Tehseels
            ['district_id' => $pishin->id, 'name' => 'Pishin City', 'code' => 'PSN-CITY', 'is_active' => true],
            ['district_id' => $pishin->id, 'name' => 'Pishin Cantonment', 'code' => 'PSN-CANT', 'is_active' => true],
            ['district_id' => $pishin->id, 'name' => 'Karez', 'code' => 'PSN-KZ', 'is_active' => true],
            ['district_id' => $pishin->id, 'name' => 'Barshor', 'code' => 'PSN-BS', 'is_active' => true],
            ['district_id' => $pishin->id, 'name' => 'Huramzai', 'code' => 'PSN-HZ', 'is_active' => true],

            // Qilla Abdullah District Tehseels
            ['district_id' => $qilla_abdullah->id, 'name' => 'Qilla Abdullah City', 'code' => 'KLA-CITY', 'is_active' => true],
            ['district_id' => $qilla_abdullah->id, 'name' => 'Qilla Abdullah Cantonment', 'code' => 'KLA-CANT', 'is_active' => true],
            ['district_id' => $qilla_abdullah->id, 'name' => 'Gulistan', 'code' => 'KLA-GS', 'is_active' => true],
            ['district_id' => $qilla_abdullah->id, 'name' => 'Chaman', 'code' => 'KLA-CH', 'is_active' => true],
            ['district_id' => $qilla_abdullah->id, 'name' => 'Boghra', 'code' => 'KLA-BG', 'is_active' => true],

            // Qilla Saifullah District Tehseels
            ['district_id' => $qilla_saifullah->id, 'name' => 'Qilla Saifullah City', 'code' => 'KLS-CITY', 'is_active' => true],
            ['district_id' => $qilla_saifullah->id, 'name' => 'Qilla Saifullah Cantonment', 'code' => 'KLS-CANT', 'is_active' => true],
            ['district_id' => $qilla_saifullah->id, 'name' => 'Muslim Bagh', 'code' => 'KLS-MB', 'is_active' => true],
            ['district_id' => $qilla_saifullah->id, 'name' => 'Zhob', 'code' => 'KLS-ZB', 'is_active' => true],
            ['district_id' => $qilla_saifullah->id, 'name' => 'Kakar Khur', 'code' => 'KLS-KK', 'is_active' => true],

            // Sherani District Tehseels
            ['district_id' => $sherani->id, 'name' => 'Sherani City', 'code' => 'SHR-CITY', 'is_active' => true],
            ['district_id' => $sherani->id, 'name' => 'Dhana Sar', 'code' => 'SHR-DS', 'is_active' => true],
            ['district_id' => $sherani->id, 'name' => 'Karama', 'code' => 'SHR-KM', 'is_active' => true],
            ['district_id' => $sherani->id, 'name' => 'Stori', 'code' => 'SHR-ST', 'is_active' => true],

            // Musakhel District Tehseels
            ['district_id' => $musakhel->id, 'name' => 'Musakhel City', 'code' => 'MSK-CITY', 'is_active' => true],
            ['district_id' => $musakhel->id, 'name' => 'Kingri', 'code' => 'MSK-KG', 'is_active' => true],
            ['district_id' => $musakhel->id, 'name' => 'Drug', 'code' => 'MSK-DR', 'is_active' => true],
            ['district_id' => $musakhel->id, 'name' => 'Rarasham', 'code' => 'MSK-RR', 'is_active' => true],

            // Barkhan District Tehseels
            ['district_id' => $barkhan->id, 'name' => 'Barkhan City', 'code' => 'BRK-CITY', 'is_active' => true],
            ['district_id' => $barkhan->id, 'name' => 'Rakhni', 'code' => 'BRK-RK', 'is_active' => true],
            ['district_id' => $barkhan->id, 'name' => 'Kohlu', 'code' => 'BRK-KH', 'is_active' => true],
            ['district_id' => $barkhan->id, 'name' => 'Dajal', 'code' => 'BRK-DJ', 'is_active' => true],

            // Duki District Tehseels
            ['district_id' => $duki->id, 'name' => 'Duki City', 'code' => 'DKI-CITY', 'is_active' => true],
            ['district_id' => $duki->id, 'name' => 'Harnai', 'code' => 'DKI-HN', 'is_active' => true],
            ['district_id' => $duki->id, 'name' => 'Sanjavi', 'code' => 'DKI-SJ', 'is_active' => true],
            ['district_id' => $duki->id, 'name' => 'Mach', 'code' => 'DKI-MC', 'is_active' => true],

            // Harnai District Tehseels
            ['district_id' => $harnai->id, 'name' => 'Harnai City', 'code' => 'HRN-CITY', 'is_active' => true],
            ['district_id' => $harnai->id, 'name' => 'Khost', 'code' => 'HRN-KS', 'is_active' => true],
            ['district_id' => $harnai->id, 'name' => 'Shahrug', 'code' => 'HRN-SR', 'is_active' => true],
            ['district_id' => $harnai->id, 'name' => 'Bazai', 'code' => 'HRN-BZ', 'is_active' => true],

            // Islamabad District Tehseels
            ['district_id' => $islamabad->id, 'name' => 'Islamabad City', 'code' => 'ISB-CITY', 'is_active' => true],
            ['district_id' => $islamabad->id, 'name' => 'G-10 Sector', 'code' => 'ISB-G10', 'is_active' => true],
            ['district_id' => $islamabad->id, 'name' => 'F-6 Sector', 'code' => 'ISB-F6', 'is_active' => true],
            ['district_id' => $islamabad->id, 'name' => 'E-7 Sector', 'code' => 'ISB-E7', 'is_active' => true],
            ['district_id' => $islamabad->id, 'name' => 'I-8 Sector', 'code' => 'ISB-I8', 'is_active' => true],
            ['district_id' => $islamabad->id, 'name' => 'H-8 Sector', 'code' => 'ISB-H8', 'is_active' => true],
            ['district_id' => $islamabad->id, 'name' => 'Blue Area', 'code' => 'ISB-BA', 'is_active' => true],
            ['district_id' => $islamabad->id, 'name' => 'Red Zone', 'code' => 'ISB-RZ', 'is_active' => true],

            // Muzaffarabad District Tehseels
            ['district_id' => $muzaffarabad->id, 'name' => 'Muzaffarabad City', 'code' => 'MZD-CITY', 'is_active' => true],
            ['district_id' => $muzaffarabad->id, 'name' => 'Muzaffarabad Cantonment', 'code' => 'MZD-CANT', 'is_active' => true],
            ['district_id' => $muzaffarabad->id, 'name' => 'Chattar', 'code' => 'MZD-CT', 'is_active' => true],
            ['district_id' => $muzaffarabad->id, 'name' => 'Noseri', 'code' => 'MZD-NS', 'is_active' => true],
            ['district_id' => $muzaffarabad->id, 'name' => 'Garhi Dupatta', 'code' => 'MZD-GD', 'is_active' => true],

            // Mirpur District Tehseels
            ['district_id' => $mirpur->id, 'name' => 'Mirpur City', 'code' => 'MRP-CITY', 'is_active' => true],
            ['district_id' => $mirpur->id, 'name' => 'Mirpur Cantonment', 'code' => 'MRP-CANT', 'is_active' => true],
            ['district_id' => $mirpur->id, 'name' => 'Kotli', 'code' => 'MRP-KT', 'is_active' => true],
            ['district_id' => $mirpur->id, 'name' => 'Bhimber', 'code' => 'MRP-BM', 'is_active' => true],
            ['district_id' => $mirpur->id, 'name' => 'Dadyal', 'code' => 'MRP-DD', 'is_active' => true],

            // Bhimber District Tehseels
            ['district_id' => $bhimber->id, 'name' => 'Bhimber City', 'code' => 'BMB-CITY', 'is_active' => true],
            ['district_id' => $bhimber->id, 'name' => 'Bhimber Cantonment', 'code' => 'BMB-CANT', 'is_active' => true],
            ['district_id' => $bhimber->id, 'name' => 'Samahni', 'code' => 'BMB-SM', 'is_active' => true],
            ['district_id' => $bhimber->id, 'name' => 'Barnala', 'code' => 'BMB-BN', 'is_active' => true],
            ['district_id' => $bhimber->id, 'name' => 'Mangla', 'code' => 'BMB-MG', 'is_active' => true],

            // Kotli District Tehseels
            ['district_id' => $kotli->id, 'name' => 'Kotli City', 'code' => 'KTL-CITY', 'is_active' => true],
            ['district_id' => $kotli->id, 'name' => 'Kotli Cantonment', 'code' => 'KTL-CANT', 'is_active' => true],
            ['district_id' => $kotli->id, 'name' => 'Sehnsa', 'code' => 'KTL-SS', 'is_active' => true],
            ['district_id' => $kotli->id, 'name' => 'Nakyal', 'code' => 'KTL-NK', 'is_active' => true],
            ['district_id' => $kotli->id, 'name' => 'Charhoi', 'code' => 'KTL-CH', 'is_active' => true],

            // Poonch District Tehseels
            ['district_id' => $poonch->id, 'name' => 'Rawalakot City', 'code' => 'PNH-CITY', 'is_active' => true],
            ['district_id' => $poonch->id, 'name' => 'Rawalakot Cantonment', 'code' => 'PNH-CANT', 'is_active' => true],
            ['district_id' => $poonch->id, 'name' => 'Hajira', 'code' => 'PNH-HJ', 'is_active' => true],
            ['district_id' => $poonch->id, 'name' => 'Tatta Pani', 'code' => 'PNH-TP', 'is_active' => true],
            ['district_id' => $poonch->id, 'name' => 'Pallandri', 'code' => 'PNH-PL', 'is_active' => true],

            // Sudhanoti District Tehseels
            ['district_id' => $sudhanoti->id, 'name' => 'Pallandri City', 'code' => 'SDN-CITY', 'is_active' => true],
            ['district_id' => $sudhanoti->id, 'name' => 'Poonch', 'code' => 'SDN-PN', 'is_active' => true],
            ['district_id' => $sudhanoti->id, 'name' => 'Rawalakot', 'code' => 'SDN-RK', 'is_active' => true],
            ['district_id' => $sudhanoti->id, 'name' => 'Hajira', 'code' => 'SDN-HJ', 'is_active' => true],

            // Bagh District Tehseels
            ['district_id' => $bagh->id, 'name' => 'Bagh City', 'code' => 'BGH-CITY', 'is_active' => true],
            ['district_id' => $bagh->id, 'name' => 'Bagh Cantonment', 'code' => 'BGH-CANT', 'is_active' => true],
            ['district_id' => $bagh->id, 'name' => 'Dhirkot', 'code' => 'BGH-DK', 'is_active' => true],
            ['district_id' => $bagh->id, 'name' => 'Sudhanoti', 'code' => 'BGH-SD', 'is_active' => true],
            ['district_id' => $bagh->id, 'name' => 'Hajira', 'code' => 'BGH-HJ', 'is_active' => true],

            // Hattian Bala District Tehseels
            ['district_id' => $hattian_bala->id, 'name' => 'Hattian Bala City', 'code' => 'HTB-CITY', 'is_active' => true],
            ['district_id' => $hattian_bala->id, 'name' => 'Chikar', 'code' => 'HTB-CK', 'is_active' => true],
            ['district_id' => $hattian_bala->id, 'name' => 'Leepa', 'code' => 'HTB-LP', 'is_active' => true],
            ['district_id' => $hattian_bala->id, 'name' => 'Chakothi', 'code' => 'HTB-CT', 'is_active' => true],

            // Haveli District Tehseels
            ['district_id' => $haveli->id, 'name' => 'Haveli City', 'code' => 'HVL-CITY', 'is_active' => true],
            ['district_id' => $haveli->id, 'name' => 'Kahuta', 'code' => 'HVL-KT', 'is_active' => true],
            ['district_id' => $haveli->id, 'name' => 'Abbaspur', 'code' => 'HVL-AP', 'is_active' => true],
            ['district_id' => $haveli->id, 'name' => 'Forward Kahuta', 'code' => 'HVL-FK', 'is_active' => true],

            // Neelum District Tehseels
            ['district_id' => $neelum->id, 'name' => 'Athmuqam City', 'code' => 'NLM-CITY', 'is_active' => true],
            ['district_id' => $neelum->id, 'name' => 'Kundal Shahi', 'code' => 'NLM-KS', 'is_active' => true],
            ['district_id' => $neelum->id, 'name' => 'Sharda', 'code' => 'NLM-SH', 'is_active' => true],
            ['district_id' => $neelum->id, 'name' => 'Kel', 'code' => 'NLM-KL', 'is_active' => true],
            ['district_id' => $neelum->id, 'name' => 'Tao Butt', 'code' => 'NLM-TB', 'is_active' => true],

            // Gilgit District Tehseels
            ['district_id' => $gilgit->id, 'name' => 'Gilgit City', 'code' => 'GLT-CITY', 'is_active' => true],
            ['district_id' => $gilgit->id, 'name' => 'Gilgit Cantonment', 'code' => 'GLT-CANT', 'is_active' => true],
            ['district_id' => $gilgit->id, 'name' => 'Jalalabad', 'code' => 'GLT-JB', 'is_active' => true],
            ['district_id' => $gilgit->id, 'name' => 'Nagar', 'code' => 'GLT-NG', 'is_active' => true],
            ['district_id' => $gilgit->id, 'name' => 'Hunza', 'code' => 'GLT-HZ', 'is_active' => true],
            ['district_id' => $gilgit->id, 'name' => 'Skardu', 'code' => 'GLT-SK', 'is_active' => true],

            // Skardu District Tehseels
            ['district_id' => $skardu->id, 'name' => 'Skardu City', 'code' => 'SKD-CITY', 'is_active' => true],
            ['district_id' => $skardu->id, 'name' => 'Skardu Cantonment', 'code' => 'SKD-CANT', 'is_active' => true],
            ['district_id' => $skardu->id, 'name' => 'Shigar', 'code' => 'SKD-SG', 'is_active' => true],
            ['district_id' => $skardu->id, 'name' => 'Khaplu', 'code' => 'SKD-KP', 'is_active' => true],
            ['district_id' => $skardu->id, 'name' => 'Kharmang', 'code' => 'SKD-KM', 'is_active' => true],
            ['district_id' => $skardu->id, 'name' => 'Ghanche', 'code' => 'SKD-GC', 'is_active' => true],

            // Ghanche District Tehseels
            ['district_id' => $ghanche->id, 'name' => 'Khaplu City', 'code' => 'GHC-CITY', 'is_active' => true],
            ['district_id' => $ghanche->id, 'name' => 'Khaplu Cantonment', 'code' => 'GHC-CANT', 'is_active' => true],
            ['district_id' => $ghanche->id, 'name' => 'Daghoni', 'code' => 'GHC-DG', 'is_active' => true],
            ['district_id' => $ghanche->id, 'name' => 'Saling', 'code' => 'GHC-SL', 'is_active' => true],
            ['district_id' => $ghanche->id, 'name' => 'Talti', 'code' => 'GHC-TT', 'is_active' => true],

            // Shigar District Tehseels
            ['district_id' => $shigar->id, 'name' => 'Shigar City', 'code' => 'SGR-CITY', 'is_active' => true],
            ['district_id' => $shigar->id, 'name' => 'Shigar Cantonment', 'code' => 'SGR-CANT', 'is_active' => true],
            ['district_id' => $shigar->id, 'name' => 'Skardu', 'code' => 'SGR-SK', 'is_active' => true],
            ['district_id' => $shigar->id, 'name' => 'Rondu', 'code' => 'SGR-RD', 'is_active' => true],
            ['district_id' => $shigar->id, 'name' => 'Khaplu', 'code' => 'SGR-KP', 'is_active' => true],

            // Kharmang District Tehseels
            ['district_id' => $kharmang->id, 'name' => 'Kharmang City', 'code' => 'KMG-CITY', 'is_active' => true],
            ['district_id' => $kharmang->id, 'name' => 'Skardu', 'code' => 'KMG-SK', 'is_active' => true],
            ['district_id' => $kharmang->id, 'name' => 'Khaplu', 'code' => 'KMG-KP', 'is_active' => true],
            ['district_id' => $kharmang->id, 'name' => 'Talti', 'code' => 'KMG-TT', 'is_active' => true],

            // Rondu District Tehseels
            ['district_id' => $rondu->id, 'name' => 'Rondu City', 'code' => 'RND-CITY', 'is_active' => true],
            ['district_id' => $rondu->id, 'name' => 'Shigar', 'code' => 'RND-SG', 'is_active' => true],
            ['district_id' => $rondu->id, 'name' => 'Skardu', 'code' => 'RND-SK', 'is_active' => true],
            ['district_id' => $rondu->id, 'name' => 'Khaplu', 'code' => 'RND-KP', 'is_active' => true],

            // Astore District Tehseels
            ['district_id' => $astore->id, 'name' => 'Astore City', 'code' => 'AST-CITY', 'is_active' => true],
            ['district_id' => $astore->id, 'name' => 'Gorikot', 'code' => 'AST-GK', 'is_active' => true],
            ['district_id' => $astore->id, 'name' => 'Chilas', 'code' => 'AST-CH', 'is_active' => true],
            ['district_id' => $astore->id, 'name' => 'Rama', 'code' => 'AST-RM', 'is_active' => true],
            ['district_id' => $astore->id, 'name' => 'Minimarg', 'code' => 'AST-MM', 'is_active' => true],

            // Diamer District Tehseels
            ['district_id' => $diamer->id, 'name' => 'Chilas City', 'code' => 'DMR-CITY', 'is_active' => true],
            ['district_id' => $diamer->id, 'name' => 'Chilas Cantonment', 'code' => 'DMR-CANT', 'is_active' => true],
            ['district_id' => $diamer->id, 'name' => 'Darel', 'code' => 'DMR-DR', 'is_active' => true],
            ['district_id' => $diamer->id, 'name' => 'Tangir', 'code' => 'DMR-TG', 'is_active' => true],
            ['district_id' => $diamer->id, 'name' => 'Raikot', 'code' => 'DMR-RK', 'is_active' => true],

            // Ghizer District Tehseels
            ['district_id' => $ghizer->id, 'name' => 'Ghizer City', 'code' => 'GZR-CITY', 'is_active' => true],
            ['district_id' => $ghizer->id, 'name' => 'Ghizer Cantonment', 'code' => 'GZR-CANT', 'is_active' => true],
            ['district_id' => $ghizer->id, 'name' => 'Gakuch', 'code' => 'GZR-GC', 'is_active' => true],
            ['district_id' => $ghizer->id, 'name' => 'Yasin', 'code' => 'GZR-YS', 'is_active' => true],
            ['district_id' => $ghizer->id, 'name' => 'Ishkoman', 'code' => 'GZR-IS', 'is_active' => true],

            // Ghakuch District Tehseels
            ['district_id' => $ghakuch->id, 'name' => 'Ghakuch City', 'code' => 'GKC-CITY', 'is_active' => true],
            ['district_id' => $ghakuch->id, 'name' => 'Ghizer', 'code' => 'GKC-GZ', 'is_active' => true],
            ['district_id' => $ghakuch->id, 'name' => 'Yasin', 'code' => 'GKC-YS', 'is_active' => true],
            ['district_id' => $ghakuch->id, 'name' => 'Ishkoman', 'code' => 'GKC-IS', 'is_active' => true],

            // Hunza District Tehseels
            ['district_id' => $hunza->id, 'name' => 'Karimabad City', 'code' => 'HNZ-CITY', 'is_active' => true],
            ['district_id' => $hunza->id, 'name' => 'Aliabad', 'code' => 'HNZ-AB', 'is_active' => true],
            ['district_id' => $hunza->id, 'name' => 'Ganish', 'code' => 'HNZ-GS', 'is_active' => true],
            ['district_id' => $hunza->id, 'name' => 'Altit', 'code' => 'HNZ-AT', 'is_active' => true],
            ['district_id' => $hunza->id, 'name' => 'Baltit', 'code' => 'HNZ-BT', 'is_active' => true],
            ['district_id' => $hunza->id, 'name' => 'Sost', 'code' => 'HNZ-ST', 'is_active' => true],

            // Nagar District Tehseels
            ['district_id' => $nagar->id, 'name' => 'Nagar City', 'code' => 'NGR-CITY', 'is_active' => true],
            ['district_id' => $nagar->id, 'name' => 'Nagar Cantonment', 'code' => 'NGR-CANT', 'is_active' => true],
            ['district_id' => $nagar->id, 'name' => 'Hunza', 'code' => 'NGR-HZ', 'is_active' => true],
            ['district_id' => $nagar->id, 'name' => 'Sost', 'code' => 'NGR-ST', 'is_active' => true],
            ['district_id' => $nagar->id, 'name' => 'Minapin', 'code' => 'NGR-MP', 'is_active' => true],
        ];

        foreach ($tehseels as $tehseel) {
            Tehseel::create($tehseel);
        }
    }
}
