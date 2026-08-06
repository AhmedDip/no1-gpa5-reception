<?php
// database/seeders/WingRegionalManagerSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\UserType;

class WingRegionalManagerSeeder extends Seeder
{
    public function run(): void
    {
        $wingManagerType     = UserType::where('slug', 'wing-manager')->first();
        $regionalManagerType = UserType::where('slug', 'regional-manager')->first();

        if (!$wingManagerType || !$regionalManagerType) {
            $this->command->error('Wing Manager / Regional Manager user types not found. Run UserTypeSeeder first.');
            return;
        }

        // ---------------------------------------------------------------
        // Wing Managers — sorted alphabetically by name
        // ---------------------------------------------------------------
        $wingManagers = [
            ['id' => 479,   'name' => '(Chattogram_Metro_R-C)Faridul Islam', 'aemp_usnm' => '017863', 'zone_id' => 323],
            ['id' => 151,   'name' => '(Chattogram_W-C)Mohammad Ali',        'aemp_usnm' => '178459', 'zone_id' => 331],
            ['id' => 130,   'name' => '(Cumilla_W-C)Shariful Islam',         'aemp_usnm' => '003525', 'zone_id' => 354],
            ['id' => 150,   'name' => '(Mymensing_W-C)Nurul Islam',          'aemp_usnm' => '002358', 'zone_id' => 434],
            ['id' => 534,   'name' => '(Narayanganj_R-C)Shipon Ali',         'aemp_usnm' => '005577', 'zone_id' => 376],
            ['id' => 172,   'name' => '(North_Bengal_W-C)Md. Shamim Uddin',  'aemp_usnm' => '116620', 'zone_id' => 450],
            ['id' => 342,   'name' => '(South_Bengal_W-C)Uzzwal Kumar Das',  'aemp_usnm' => '178455', 'zone_id' => 468],
            ['id' => 36,    'name' => '(Sylhet_North_R-C)Md. Abul Kalam',    'aemp_usnm' => '061285', 'zone_id' => 487],
            ['id' => 428,   'name' => '(Sylhet_W-C)Raju Ahammed',            'aemp_usnm' => '172051', 'zone_id' => 492],
            ['id' => 33770, 'name' => 'Abdur Rahim Sheikh Rintu (AGM-C)',    'aemp_usnm' => '004045', 'zone_id' => 392],
            ['id' => 31176, 'name' => 'Arjun Chandra Nath (AGM-C)',          'aemp_usnm' => '127955', 'zone_id' => 370],
            ['id' => 27282, 'name' => 'Raton Mojumder (AGM-C)',              'aemp_usnm' => '159205', 'zone_id' => 477],
        ];

        // Sort wing managers by ID in ascending order
        usort($wingManagers, function($a, $b) {
            return $a['id'] - $b['id'];
        });

        foreach ($wingManagers as $wm) {
            $this->createUser($wm, $wingManagerType->id, 1);
        }

        // ---------------------------------------------------------------
        // Regional Managers — grouped by Wing Manager id (same order as
        // above), sorted alphabetically by name within each group.
        // ---------------------------------------------------------------
        $regionalManagers = [
            // Reports to: (Chattogram_Metro_R-C)Faridul Islam [479]
            ['id' => 511,  'name' => '(Agrabad_T-C)Md. Shakhawat Khan',            'aemp_usnm' => '162530', 'aemp_mngr' => 479, 'zone_id' => 320],
            ['id' => 847,  'name' => '(Halishahar_T-C)Helal Uddin',                'aemp_usnm' => '114878', 'aemp_mngr' => 479, 'zone_id' => 321],
            ['id' => 1128, 'name' => '(Patenga_T-C)Karimul Islam',                 'aemp_usnm' => '165649', 'aemp_mngr' => 479, 'zone_id' => 322],
            ['id' => 213,  'name' => '(Riazuddin_Bazar_T-C)Mohammad Mehedi Hassan','aemp_usnm' => '122309', 'aemp_mngr' => 479, 'zone_id' => 323],

            // Reports to: (Chattogram_W-C)Mohammad Ali [151]
            ['id' => 345,  'name' => '(Chattogram_North_R-C)Md. Abdullah Al Hammad', 'aemp_usnm' => '178460', 'aemp_mngr' => 151, 'zone_id' => 310],
            ['id' => 1178, 'name' => "(Cox's_Bazar_R-C)Nazmul Haque",                'aemp_usnm' => '002945', 'aemp_mngr' => 151, 'zone_id' => 314],
            ['id' => 1176, 'name' => '(Hathazari_R-C)Joydeb Saha',                   'aemp_usnm' => '008091', 'aemp_mngr' => 151, 'zone_id' => 327],
            ['id' => 1247, 'name' => '(Pahartoli_R-C)Emran Khan',                    'aemp_usnm' => '003597', 'aemp_mngr' => 151, 'zone_id' => 329],
            ['id' => 853,  'name' => '(Patiya_R-C)Zia Uddin Bablu',                  'aemp_usnm' => '005585', 'aemp_mngr' => 151, 'zone_id' => 319],

            // Reports to: (Cumilla_W-C)Shariful Islam [130]
            ['id' => 581,  'name' => '(Brahmanbaria_R-C)Rafiqul Islam',        'aemp_usnm' => '004788', 'aemp_mngr' => 130, 'zone_id' => 336],
            ['id' => 191,  'name' => '(Chandpur_R-C)Zakir Hossain Khandaker',  'aemp_usnm' => '003041', 'aemp_mngr' => 130, 'zone_id' => 339],
            ['id' => 286,  'name' => '(Cumilla_R-C)Rana Barua',                'aemp_usnm' => '003081', 'aemp_mngr' => 130, 'zone_id' => 344],
            ['id' => 589,  'name' => '(Feni_R-C)Fakhrul Islam Sojib',          'aemp_usnm' => '021239', 'aemp_mngr' => 130, 'zone_id' => 347],
            ['id' => 500,  'name' => '(Lakshmipur_R-C)Belal Hossain',          'aemp_usnm' => '004585', 'aemp_mngr' => 130, 'zone_id' => 351],
            ['id' => 13159, 'name' => '(Noakhali_R-C)Muhammad Tanjir Hossain', 'aemp_usnm' => '005486', 'aemp_mngr' => 130, 'zone_id' => 354],

            // Reports to: (Mymensing_W-C)Nurul Islam [150]
            ['id' => 260,  'name' => '(Gazipur_R-C)Jahidul Islam',   'aemp_usnm' => '003084', 'aemp_mngr' => 150, 'zone_id' => 410],
            ['id' => 1213, 'name' => '(Joydebpur_R-C)Nasim Wahab',   'aemp_usnm' => '075912', 'aemp_mngr' => 150, 'zone_id' => 411],
            ['id' => 401,  'name' => '(Mymensing_R-C)Nur Uddin',     'aemp_usnm' => '016293', 'aemp_mngr' => 150, 'zone_id' => 424],
            ['id' => 176,  'name' => '(Savar_R-C)Ashraful Islam',    'aemp_usnm' => '004538', 'aemp_mngr' => 150, 'zone_id' => 423],

            // Reports to: (Narayanganj_R-C)Shipon Ali [534]
            ['id' => 935,  'name' => '(Adamjee_T-C)Hannan Mojumder',       'aemp_usnm' => '009546', 'aemp_mngr' => 534, 'zone_id' => 373],
            ['id' => 179,  'name' => '(Bondor_T-C)Md. Nizamuddin',        'aemp_usnm' => '158183', 'aemp_mngr' => 534, 'zone_id' => 374],
            ['id' => 4455, 'name' => '(Narayanganj_T-C)Md. Akash Hosen',  'aemp_usnm' => '129524', 'aemp_mngr' => 534, 'zone_id' => 375],
            ['id' => 255,  'name' => '(Sonargaon_T-C)Md. Shahinur Rahman','aemp_usnm' => '134305', 'aemp_mngr' => 534, 'zone_id' => 376],

            // Reports to: (North_Bengal_W-C)Md. Shamim Uddin [172]
            ['id' => 284,  'name' => '(Bogura_R-C)Md. Sabuj Miah',     'aemp_usnm' => '138059', 'aemp_mngr' => 172, 'zone_id' => 438],
            ['id' => 216,  'name' => '(Dinajpur_R-C)Azadul Islam',     'aemp_usnm' => '003059', 'aemp_mngr' => 172, 'zone_id' => 445],
            ['id' => 197,  'name' => '(Rajshahi_R-C)Nur Nobi Sarkar',  'aemp_usnm' => '138058', 'aemp_mngr' => 172, 'zone_id' => 442],
            ['id' => 244,  'name' => '(Rangpur_R-C)Iqbal Nabi',        'aemp_usnm' => '003174', 'aemp_mngr' => 172, 'zone_id' => 450],

            // Reports to: (South_Bengal_W-C)Uzzwal Kumar Das [342]
            ['id' => 515,  'name' => '(Barishal_R-C)Biplob Kumar Biswas',  'aemp_usnm' => '166562', 'aemp_mngr' => 342, 'zone_id' => 452],
            ['id' => 371,  'name' => '(Faridpur_R-C)Kartik Chandra Ghosh', 'aemp_usnm' => '003924', 'aemp_mngr' => 342, 'zone_id' => 458],
            ['id' => 308,  'name' => '(Jashore_R-C)Madhu Sudan Das',       'aemp_usnm' => '006977', 'aemp_mngr' => 342, 'zone_id' => 466],
            ['id' => 252,  'name' => '(Khulna_R-C)Azad Fakir',             'aemp_usnm' => '003221', 'aemp_mngr' => 342, 'zone_id' => 474],
            ['id' => 584,  'name' => '(Patuakhali_R-C)Elyas Bhuiyan',      'aemp_usnm' => '000233', 'aemp_mngr' => 342, 'zone_id' => 465],

            // Reports to: (Sylhet_North_R-C)Md. Abul Kalam [36]
            ['id' => 394,  'name' => '(Jointapur_T-C)Md. Yusuf Ali', 'aemp_usnm' => '176071', 'aemp_mngr' => 36, 'zone_id' => 484],

            // Reports to: (Sylhet_W-C)Raju Ahammed [428]
            ['id' => 217,  'name' => '(Sreemangal_R-C)Abu Sayed',          'aemp_usnm' => '003962', 'aemp_mngr' => 428, 'zone_id' => 480],
            ['id' => 934,  'name' => '(Sunamganj_R-C)Mizanur Rahman',      'aemp_usnm' => '003108', 'aemp_mngr' => 428, 'zone_id' => 483],
            ['id' => 407,  'name' => '(Sylhet_South_R-C)Md. Aminul Islam', 'aemp_usnm' => '164325', 'aemp_mngr' => 428, 'zone_id' => 492],

            // Reports to: Abdur Rahim Sheikh Rintu (AGM-C) [33770]
            ['id' => 954,  'name' => '(Narsingdi_R-C)Md.Zohurul Islam', 'aemp_usnm' => '045748', 'aemp_mngr' => 33770, 'zone_id' => 381],
            ['id' => 378,  'name' => '(Uttara_R-C)Delwar Hossain',      'aemp_usnm' => '039475', 'aemp_mngr' => 33770, 'zone_id' => 407],

            // Reports to: Arjun Chandra Nath (AGM-C) [31176]
            ['id' => 193,  'name' => '(Khilgaon_R-C)Imdadul Huq Mollah',  'aemp_usnm' => '003040', 'aemp_mngr' => 31176, 'zone_id' => 367],
            ['id' => 207,  'name' => '(Mirpur_R-C)Rakibul Hasan',         'aemp_usnm' => '003049', 'aemp_mngr' => 31176, 'zone_id' => 390],
            ['id' => 582,  'name' => '(Mohammadpur_R-C)Emdadul Haque',    'aemp_usnm' => '005475', 'aemp_mngr' => 31176, 'zone_id' => 397],

            // Reports to: Raton Mojumder (AGM-C) [27282]
            ['id' => 192,  'name' => '(Fatulla_R-C)Anowarul Karim Mazumder', 'aemp_usnm' => '002935', 'aemp_mngr' => 27282, 'zone_id' => 372],
            ['id' => 1210, 'name' => '(Gulshan_R-C)Shafiqur Rahman',         'aemp_usnm' => '005476', 'aemp_mngr' => 27282, 'zone_id' => 402],
            ['id' => 190,  'name' => '(Jatrabari_R-C)Mojidur Rahman',        'aemp_usnm' => '017283', 'aemp_mngr' => 27282, 'zone_id' => 357],
            ['id' => 133017, 'name' => '(Lalbag_R-C)Masum Billah',           'aemp_usnm' => '133017', 'aemp_mngr' => 27282, 'zone_id' => 383],

            //missing ids add
            ['id' => 489,  'name' => '(Tangail_R-C)Md. Zafar Ullah',    'aemp_usnm' => '003042', 'aemp_mngr' => 150, 'zone_id' => 434],
        ];

        // Sort regional managers by ID in ascending order
        usort($regionalManagers, function($a, $b) {
            return $a['id'] - $b['id'];
        });

        foreach ($regionalManagers as $rm) {
            $this->createUser($rm, $regionalManagerType->id, $rm['aemp_mngr']);
        }

        $this->command->info(sprintf(
            'Wing/Regional Manager seeding complete: %d wing managers, %d regional managers.',
            count($wingManagers),
            count($regionalManagers)
        ));
    }

    /**
     * Create (or skip if already exists) a manager-type user.
     * email + mobile are both set to the staff ID (aemp_usnm) as per spec,
     * since the users table requires a unique, non-null mobile.
     */
    private function createUser(array $data, int $userTypeId, int $managerId): void
    {
        // Use updateOrCreate with the ID as the unique identifier
        User::updateOrCreate(
            ['id' => $data['id']],
            [
                'name'                => $data['name'],
                'email'               => $data['aemp_usnm'],
                'password'            => Hash::make($data['aemp_usnm']),
                'user_type_id'        => $userTypeId,
                'aemp_mngr'           => $managerId,
                'zone_id'             => $data['zone_id'],
                'is_mobile_verified'  => true,
                'wmng_id'             => 2,
                'mobile_verified_at'  => now(),
            ]
        );
    }
}
