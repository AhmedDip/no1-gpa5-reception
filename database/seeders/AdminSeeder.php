<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\UserType;
use App\Models\WebMenuGroup;
use App\Models\WebMenu;
use App\Models\SubMenu;
use App\Models\UserGroupMenu;

class AdminSeeder extends Seeder
{
    public function run(): void
    {

        $adminType = UserType::firstOrCreate(['slug' => 'admin'], [
            'name' => 'Admin',
            'slug' => 'admin',
        ]);

        $brandType = UserType::firstOrCreate(['slug' => 'brand-team'], [
            'name' => 'No.1 Brand Team',
            'slug' => 'brand-team',
        ]);


        $adminGroup = WebMenuGroup::firstOrCreate(['wmng_code' => 'ADMIN'], [
            'wmng_name' => 'Admin',
            'wmng_code' => 'ADMIN',
        ]);

        $brandGroup = WebMenuGroup::firstOrCreate(['wmng_code' => 'BRAND'], [
            'wmng_name' => 'Brand Team',
            'wmng_code' => 'BRAND',
        ]);


        $superAdmin = User::firstOrCreate(['email' => 'admin@no1.com'], [
            'name'              => 'Super Admin',
            'mobile'            => '01700000000',
            'email'             => 'admin@no1.com',
            'password'          => Hash::make('Admin@1234'),
            'user_type_id'      => $adminType->id,
            'wmng_id'           => $adminGroup->id,
            'is_mobile_verified'=> true,
            'mobile_verified_at'=> now(),
        ]);

        $brandUser = User::firstOrCreate(['email' => 'brand@no1.com'], [
            'name'              => 'Brand Manager',
            'mobile'            => '01700000001',
            'email'             => 'brand@no1.com',
            'password'          => Hash::make('Brand@1234'),
            'user_type_id'      => $brandType->id,
            'wmng_id'           => $brandGroup->id,
            'is_mobile_verified'=> true,
            'mobile_verified_at'=> now(),
        ]);


        $dashboardMenu = WebMenu::firstOrCreate(['wmnu_name' => 'Dashboard'], [
            'wmnu_name' => 'Dashboard',
            'wmnu_icon' => 'bx bx-home-smile',
            'wmnu_oseq' => 1,
        ]);

        $applicationMenu = WebMenu::firstOrCreate(['wmnu_name' => 'Applications'], [
            'wmnu_name' => 'Applications',
            'wmnu_icon' => 'bx bx-file',
            'wmnu_oseq' => 2,
        ]);

        $studentMenu = WebMenu::firstOrCreate(['wmnu_name' => 'Students'], [
            'wmnu_name' => 'Students',
            'wmnu_icon' => 'bx bx-user-circle',
            'wmnu_oseq' => 3,
        ]);

        $reportMenu = WebMenu::firstOrCreate(['wmnu_name' => 'Reports'], [
            'wmnu_name' => 'Reports',
            'wmnu_icon' => 'bx bx-bar-chart-alt-2',
            'wmnu_oseq' => 4,
        ]);

        $settingsMenu = WebMenu::firstOrCreate(['wmnu_name' => 'Settings'], [
            'wmnu_name' => 'Settings',
            'wmnu_icon' => 'bx bx-cog',
            'wmnu_oseq' => 5,
        ]);


        $subMenus = [
            // Dashboard
            [
                'wmnu_id'    => $dashboardMenu->id,
                'wsmn_name'  => 'Overview',
                'wsmn_wurl'  => '/admin/dashboard',
                'wsmn_oseq'  => 1,
                'wsmn_ukey'  => 'dashboard.overview',
            ],
            [
                'wmnu_id'    => $dashboardMenu->id,
                'wsmn_name'  => 'Statistics',
                'wsmn_wurl'  => '/admin/dashboard/stats',
                'wsmn_oseq'  => 2,
                'wsmn_ukey'  => 'dashboard.statistics',
            ],

            // Applications
            [
                'wmnu_id'    => $applicationMenu->id,
                'wsmn_name'  => 'All Applications',
                'wsmn_wurl'  => '/admin/applications',
                'wsmn_oseq'  => 1,
                'wsmn_ukey'  => 'applications.list',
            ],
            [
                'wmnu_id'    => $applicationMenu->id,
                'wsmn_name'  => 'Pending Review',
                'wsmn_wurl'  => '/admin/applications?status=1',
                'wsmn_oseq'  => 2,
                'wsmn_ukey'  => 'applications.pending',
            ],
            [
                'wmnu_id'    => $applicationMenu->id,
                'wsmn_name'  => 'Approved',
                'wsmn_wurl'  => '/admin/applications?status=2',
                'wsmn_oseq'  => 3,
                'wsmn_ukey'  => 'applications.approved',
            ],
            [
                'wmnu_id'    => $applicationMenu->id,
                'wsmn_name'  => 'Rejected',
                'wsmn_wurl'  => '/admin/applications?status=3',
                'wsmn_oseq'  => 4,
                'wsmn_ukey'  => 'applications.rejected',
            ],

            // Students
            [
                'wmnu_id'    => $studentMenu->id,
                'wsmn_name'  => 'Student List',
                'wsmn_wurl'  => '/admin/students',
                'wsmn_oseq'  => 1,
                'wsmn_ukey'  => 'students.list',
            ],
            [
                'wmnu_id'    => $studentMenu->id,
                'wsmn_name'  => 'Verified Students',
                'wsmn_wurl'  => '/admin/students/verified',
                'wsmn_oseq'  => 2,
                'wsmn_ukey'  => 'students.verified',
            ],

            // Reports
            [
                'wmnu_id'    => $reportMenu->id,
                'wsmn_name'  => 'Application Report',
                'wsmn_wurl'  => '/admin/reports/applications',
                'wsmn_oseq'  => 1,
                'wsmn_ukey'  => 'reports.applications',
            ],
            [
                'wmnu_id'    => $reportMenu->id,
                'wsmn_name'  => 'Division-wise Report',
                'wsmn_wurl'  => '/admin/reports/division',
                'wsmn_oseq'  => 2,
                'wsmn_ukey'  => 'reports.division',
            ],
            [
                'wmnu_id'    => $reportMenu->id,
                'wsmn_name'  => 'Export Data',
                'wsmn_wurl'  => '/admin/reports/export',
                'wsmn_oseq'  => 3,
                'wsmn_ukey'  => 'reports.export',
            ],

            // Settings
            [
                'wmnu_id'    => $settingsMenu->id,
                'wsmn_name'  => 'User Management',
                'wsmn_wurl'  => '/admin/settings/users',
                'wsmn_oseq'  => 1,
                'wsmn_ukey'  => 'settings.users',
            ],
            [
                'wmnu_id'    => $settingsMenu->id,
                'wsmn_name'  => 'Menu Permissions',
                'wsmn_wurl'  => '/admin/settings/permissions',
                'wsmn_oseq'  => 2,
                'wsmn_ukey'  => 'settings.permissions',
            ],
            [
                'wmnu_id'    => $settingsMenu->id,
                'wsmn_name'  => 'Application Status',
                'wsmn_wurl'  => '/admin/settings/statuses',
                'wsmn_oseq'  => 3,
                'wsmn_ukey'  => 'settings.statuses',
            ],
        ];

        $createdSubMenus = [];
        foreach ($subMenus as $sm) {
            $record = SubMenu::firstOrCreate(['wsmn_ukey' => $sm['wsmn_ukey']], $sm);
            $createdSubMenus[$sm['wsmn_ukey']] = $record;
        }


        foreach ($createdSubMenus as $ukey => $subMenu) {
            UserGroupMenu::firstOrCreate(
                ['wsmn_id' => $subMenu->id, 'wmng_id' => $adminGroup->id],
                [
                    'wsmn_id'   => $subMenu->id,
                    'wmng_id'   => $adminGroup->id,
                    'wsmu_vsbl' => true,
                    'wsmu_crat' => true,
                    'wsmu_read' => true,
                    'wsmu_updt' => true,
                    'wsmu_delt' => true,
                ]
            );
        }


        $brandPermissions = [
            'dashboard.overview'     => [true,  false, true,  false, false],
            'dashboard.statistics'   => [true,  false, true,  false, false],
            'applications.list'      => [true,  false, true,  false, false],
            'applications.pending'   => [true,  false, true,  false, false],
            'applications.approved'  => [true,  false, true,  false, false],
            'applications.rejected'  => [true,  false, true,  false, false],
            'students.list'          => [true,  false, true,  false, false],
            'students.verified'      => [true,  false, true,  false, false],
            'reports.applications'   => [true,  false, true,  false, false],
            'reports.division'       => [true,  false, true,  false, false],
            'reports.export'         => [false, false, false, false, false], // hidden
            'settings.users'         => [false, false, false, false, false], // hidden
            'settings.permissions'   => [false, false, false, false, false], // hidden
            'settings.statuses'      => [false, false, false, false, false], // hidden
        ];

        foreach ($brandPermissions as $ukey => [$vsbl, $crat, $read, $updt, $delt]) {
            if (!isset($createdSubMenus[$ukey])) continue;
            $subMenu = $createdSubMenus[$ukey];

            UserGroupMenu::firstOrCreate(
                ['wsmn_id' => $subMenu->id, 'wmng_id' => $brandGroup->id],
                [
                    'wsmn_id'   => $subMenu->id,
                    'wmng_id'   => $brandGroup->id,
                    'wsmu_vsbl' => $vsbl,
                    'wsmu_crat' => $crat,
                    'wsmu_read' => $read,
                    'wsmu_updt' => $updt,
                    'wsmu_delt' => $delt,
                ]
            );
        }

        $this->command->info('Admin seeder completed!');
        $this->command->table(
            ['Role', 'Email', 'Password'],
            [
                ['Super Admin', 'admin@no1.com', 'Admin@1234'],
                ['Brand Team',  'brand@no1.com', 'Brand@1234'],
            ]
        );
    }
}
