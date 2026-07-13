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
            ['id' => 2,   'name' => '(Chattogram_Metro_R-C)Faridul Islam', 'aemp_usnm' => '017863'],
            ['id' => 3,   'name' => '(Chattogram_W-C)Mohammad Ali',        'aemp_usnm' => '178459'],
            ['id' => 4,   'name' => '(Cumilla_W-C)Shariful Islam',         'aemp_usnm' => '003525'],
            ['id' => 5,   'name' => '(Mymensing_W-C)Nurul Islam',          'aemp_usnm' => '002358'],
            ['id' => 6,   'name' => '(Narayanganj_R-C)Shipon Ali',         'aemp_usnm' => '005577'],
            ['id' => 7,   'name' => '(North_Bengal_W-C)Md. Shamim Uddin',  'aemp_usnm' => '116620'],
            ['id' => 8,   'name' => '(South_Bengal_W-C)Uzzwal Kumar Das',  'aemp_usnm' => '178455'],
            ['id' => 9,    'name' => '(Sylhet_North_R-C)Md. Abul Kalam',    'aemp_usnm' => '061285'],
            ['id' => 10,   'name' => '(Sylhet_W-C)Raju Ahammed',            'aemp_usnm' => '172051'],
            ['id' => 11, 'name' => 'Abdur Rahim Sheikh Rintu (AGM-C)',    'aemp_usnm' => '004045'],
            ['id' => 12, 'name' => 'Arjun Chandra Nath (AGM-C)',          'aemp_usnm' => '127955'],
            ['id' => 13, 'name' => 'Raton Mojumder (AGM-C)',              'aemp_usnm' => '159205'],
        ];

        foreach ($wingManagers as $wm) {
            $this->createUser($wm, $wingManagerType->id, 1);
        }

        // ---------------------------------------------------------------
        // Regional Managers — grouped by Wing Manager id (same order as
        // above), sorted alphabetically by name within each group.
        // ---------------------------------------------------------------
        $regionalManagers = [
            // Reports to: (Chattogram_Metro_R-C)Faridul Islam [479]
            ['id' => 14,  'name' => '(Agrabad_T-C)Md. Shakhawat Khan',            'aemp_usnm' => '162530', 'aemp_mngr' => 2],
            ['id' => 15,  'name' => '(Halishahar_T-C)Helal Uddin',                'aemp_usnm' => '114878', 'aemp_mngr' => 2],
            ['id' => 16, 'name' => '(Patenga_T-C)Karimul Islam',                 'aemp_usnm' => '165649', 'aemp_mngr' => 2],
            ['id' => 17,  'name' => '(Riazuddin_Bazar_T-C)Mohammad Mehedi Hassan','aemp_usnm' => '122309', 'aemp_mngr' => 2],

            // Reports to: (Chattogram_W-C)Mohammad Ali [151]
            ['id' => 18,  'name' => '(Chattogram_North_R-C)Md. Abdullah Al Hammad', 'aemp_usnm' => '178460', 'aemp_mngr' => 3],
            ['id' => 19, 'name' => "(Cox's_Bazar_R-C)Nazmul Haque",                'aemp_usnm' => '002945', 'aemp_mngr' => 3],
            ['id' => 20, 'name' => '(Hathazari_R-C)Joydeb Saha',                   'aemp_usnm' => '008091', 'aemp_mngr' => 3],
            ['id' => 21, 'name' => '(Pahartoli_R-C)Emran Khan',                    'aemp_usnm' => '003597', 'aemp_mngr' => 3],
            ['id' => 22,  'name' => '(Patiya_R-C)Zia Uddin Bablu',                  'aemp_usnm' => '005585', 'aemp_mngr' => 3],

            // Reports to: (Cumilla_W-C)Shariful Islam [130]
            ['id' => 23,   'name' => '(Brahmanbaria_R-C)Rafiqul Islam',        'aemp_usnm' => '004788', 'aemp_mngr' => 4],
            ['id' => 24,   'name' => '(Chandpur_R-C)Zakir Hossain Khandaker',  'aemp_usnm' => '003041', 'aemp_mngr' => 4],
            ['id' => 25,   'name' => '(Cumilla_R-C)Rana Barua',                'aemp_usnm' => '003081', 'aemp_mngr' => 4],
            ['id' => 26,   'name' => '(Feni_R-C)Fakhrul Islam Sojib',          'aemp_usnm' => '021239', 'aemp_mngr' => 4],
            ['id' => 27,   'name' => '(Lakshmipur_R-C)Belal Hossain',          'aemp_usnm' => '004585', 'aemp_mngr' => 4],
            ['id' => 28, 'name' => '(Noakhali_R-C)Muhammad Tanjir Hossain',  'aemp_usnm' => '005486', 'aemp_mngr' => 4],

            // Reports to: (Mymensing_W-C)Nurul Islam [150]
            ['id' => 29,  'name' => '(Gazipur_R-C)Jahidul Islam',   'aemp_usnm' => '003084', 'aemp_mngr' => 5],
            ['id' => 30, 'name' => '(Joydebpur_R-C)Nasim Wahab',   'aemp_usnm' => '075912', 'aemp_mngr' => 5],
            ['id' => 31,  'name' => '(Mymensing_R-C)Nur Uddin',     'aemp_usnm' => '016293', 'aemp_mngr' => 5],
            ['id' => 32,  'name' => '(Savar_R-C)Ashraful Islam',    'aemp_usnm' => '004538', 'aemp_mngr' => 5],

            // Reports to: (Narayanganj_R-C)Shipon Ali [534]
            ['id' => 33,  'name' => '(Adamjee_T-C)Hannan Mojumder',       'aemp_usnm' => '009546', 'aemp_mngr' => 6],
            ['id' => 34,  'name' => '(Bondor_T-C)Md. Nizamuddin',        'aemp_usnm' => '158183', 'aemp_mngr' => 6],
            ['id' => 35, 'name' => '(Narayanganj_T-C)Md. Akash Hosen',  'aemp_usnm' => '129524', 'aemp_mngr' => 6],
            ['id' => 36,  'name' => '(Sonargaon_T-C)Md. Shahinur Rahman','aemp_usnm' => '134305', 'aemp_mngr' => 6],

            // Reports to: (North_Bengal_W-C)Md. Shamim Uddin [172]
            ['id' => 37, 'name' => '(Bogura_R-C)Md. Sabuj Miah',     'aemp_usnm' => '138059', 'aemp_mngr' => 7],
            ['id' => 38, 'name' => '(Dinajpur_R-C)Azadul Islam',     'aemp_usnm' => '003059', 'aemp_mngr' => 7],
            ['id' => 39, 'name' => '(Rajshahi_R-C)Nur Nobi Sarkar',  'aemp_usnm' => '138058', 'aemp_mngr' => 7],
            ['id' => 40, 'name' => '(Rangpur_R-C)Iqbal Nabi',        'aemp_usnm' => '003174', 'aemp_mngr' => 7],

            // Reports to: (South_Bengal_W-C)Uzzwal Kumar Das [342]
            ['id' => 41, 'name' => '(Barishal_R-C)Biplob Kumar Biswas',  'aemp_usnm' => '166562', 'aemp_mngr' => 8],
            ['id' => 42, 'name' => '(Faridpur_R-C)Kartik Chandra Ghosh','aemp_usnm' => '003924', 'aemp_mngr' => 8],
            ['id' => 43, 'name' => '(Jashore_R-C)Madhu Sudan Das',      'aemp_usnm' => '006977', 'aemp_mngr' => 8],
            ['id' => 44, 'name' => '(Khulna_R-C)Azad Fakir',            'aemp_usnm' => '003221', 'aemp_mngr' => 8],
            ['id' => 45, 'name' => '(Patuakhali_R-C)Elyas Bhuiyan',     'aemp_usnm' => '000233', 'aemp_mngr' => 8],

            // Reports to: (Sylhet_North_R-C)Md. Abul Kalam [36]
            ['id' => 46, 'name' => '(Jointapur_T-C)Md. Yusuf Ali', 'aemp_usnm' => '176071', 'aemp_mngr' => 9],

            // Reports to: (Sylhet_W-C)Raju Ahammed [428]
            ['id' => 47, 'name' => '(Sreemangal_R-C)Abu Sayed',          'aemp_usnm' => '003962', 'aemp_mngr' => 10],
            ['id' => 48, 'name' => '(Sunamganj_R-C)Mizanur Rahman',      'aemp_usnm' => '003108', 'aemp_mngr' => 10],
            ['id' => 49, 'name' => '(Sylhet_South_R-C)Md. Aminul Islam','aemp_usnm' => '164325', 'aemp_mngr' => 10],

            // Reports to: Abdur Rahim Sheikh Rintu (AGM-C) [33770]
            ['id' => 50, 'name' => '(Narsingdi_R-C)Md.Zohurul Islam', 'aemp_usnm' => '045748', 'aemp_mngr' => 11],
            ['id' => 51, 'name' => '(Uttara_R-C)Delwar Hossain',      'aemp_usnm' => '039475', 'aemp_mngr' => 11],

            // Reports to: Arjun Chandra Nath (AGM-C) [31176]
            ['id' => 52, 'name' => '(Khilgaon_R-C)Imdadul Huq Mollah',  'aemp_usnm' => '003040', 'aemp_mngr' => 12],
            ['id' => 53, 'name' => '(Mirpur_R-C)Rakibul Hasan',         'aemp_usnm' => '003049', 'aemp_mngr' => 12],
            ['id' => 54, 'name' => '(Mohammadpur_R-C)Emdadul Haque',    'aemp_usnm' => '005475', 'aemp_mngr' => 12],

            // Reports to: Raton Mojumder (AGM-C) [27282]
            ['id' => 55,  'name' => '(Fatulla_R-C)Anowarul Karim Mazumder', 'aemp_usnm' => '002935', 'aemp_mngr' => 13],
            ['id' => 56, 'name' => '(Gulshan_R-C)Shafiqur Rahman',         'aemp_usnm' => '005476', 'aemp_mngr' => 13],
            ['id' => 57,  'name' => '(Jatrabari_R-C)Mojidur Rahman',        'aemp_usnm' => '017283', 'aemp_mngr' => 13],
            ['id' => 58,  'name' => '(Lalbag_R-C)Masum Billah',             'aemp_usnm' => '133017', 'aemp_mngr' => 13],
        ];

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
        User::firstOrCreate(
            ['email' => $data['aemp_usnm']],
            [
                'name'                => $data['name'],
                // 'mobile'              => $data['aemp_usnm'],
                'email'               => $data['aemp_usnm'],
                'password'            => Hash::make($data['aemp_usnm']),
                'user_type_id'        => $userTypeId,
                'aemp_mngr'           => $managerId,
                'is_mobile_verified'  => true,
                'wmng_id'             => 1,
                'mobile_verified_at'  => now(),
            ]
        );
    }
}
