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

        $adminGroup = WebMenuGroup::firstOrCreate(['wmng_code' => 'ADMIN'], [
            'wmng_name' => 'Admin',
            'wmng_code' => 'ADMIN',
        ]);


        $managerGroup = WebMenuGroup::firstOrCreate(['wmng_code' => 'MANAGER'], [
            'wmng_name' => 'Manager',
            'wmng_code' => 'MANAGER',
        ]);

        $superAdmin = User::firstOrCreate(['email' => 'admin@gmail.com'], [
            'name'                => 'Super Admin',
            'mobile'              => '01700000000',
            'email'               => 'admin@no1.com',
            'password'            => Hash::make('123456'),
            'user_type_id'        => $adminType->id,
            'wmng_id'             => $adminGroup->id,
            'is_mobile_verified'  => true,
            'mobile_verified_at'  => now(),
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


        $reportMenu = WebMenu::firstOrCreate(['wmnu_name' => 'Reports'], [
            'wmnu_name' => 'Reports',
            'wmnu_icon' => 'bx bx-bar-chart-alt-2',
            'wmnu_oseq' => 3,
        ]);

        $settingsMenu = WebMenu::firstOrCreate(['wmnu_name' => 'Settings'], [
            'wmnu_name' => 'Settings',
            'wmnu_icon' => 'bx bx-cog',
            'wmnu_oseq' => 4,
        ]);


        $subMenus = [
            // Dashboard
            [
                'wmnu_id'   => $dashboardMenu->id,
                'wsmn_name' => 'Overview',
                'wsmn_wurl' => '/admin/dashboard',
                'wsmn_oseq' => 1,
                'wsmn_ukey' => 'dashboard.overview',
            ],

            // Applications
            [
                'wmnu_id'   => $applicationMenu->id,
                'wsmn_name' => 'All Applications',
                'wsmn_wurl' => '/admin/applications',
                'wsmn_oseq' => 1,
                'wsmn_ukey' => 'applications.list',
            ],
            [
                'wmnu_id'   => $applicationMenu->id,
                'wsmn_name' => 'Pending Review',
                'wsmn_wurl' => '/admin/applications?status=1',
                'wsmn_oseq' => 2,
                'wsmn_ukey' => 'applications.pending',
            ],
            [
                'wmnu_id'   => $applicationMenu->id,
                'wsmn_name' => 'Approved',
                'wsmn_wurl' => '/admin/applications?status=6',
                'wsmn_oseq' => 3,
                'wsmn_ukey' => 'applications.approved',
            ],
            [
                'wmnu_id'   => $applicationMenu->id,
                'wsmn_name' => 'Rejected',
                'wsmn_wurl' => '/admin/applications?status=7',
                'wsmn_oseq' => 4,
                'wsmn_ukey' => 'applications.rejected',
            ],


            // Reports
            [
                'wmnu_id'   => $reportMenu->id,
                'wsmn_name' => 'SMS Logs Report',
                'wsmn_wurl' => '/admin/sms-logs',
                'wsmn_oseq' => 1,
                'wsmn_ukey' => 'reports.sms-logs',
            ],

            // Settings — Menu Management module

            [
                'wmnu_id'   => $settingsMenu->id,
                'wsmn_name' => 'Web Menus',
                'wsmn_wurl' => '/admin/menu-management/web-menus',
                'wsmn_oseq' => 1,
                'wsmn_ukey' => 'settings.web-menus',
            ],
            [
                'wmnu_id'   => $settingsMenu->id,
                'wsmn_name' => 'Sub Menus',
                'wsmn_wurl' => '/admin/menu-management/sub-menus',
                'wsmn_oseq' => 2,
                'wsmn_ukey' => 'settings.sub-menus',
            ],
            [
                'wmnu_id'   => $settingsMenu->id,
                'wsmn_name' => 'Permissions',
                'wsmn_wurl' => '/admin/menu-management/permissions',
                'wsmn_oseq' => 3,
                'wsmn_ukey' => 'settings.permissions',
            ],
            [
                'wmnu_id'   => $settingsMenu->id,
                'wsmn_name' => 'Upazila Manager Assignments',
                'wsmn_wurl' => '/admin/upazila-manager-assignments',
                'wsmn_oseq' => 4,
                'wsmn_ukey' => 'settings.upazila-manager-assignments',
            ],
        ];

        $createdSubMenus = [];
        foreach ($subMenus as $sm) {
            $record = SubMenu::firstOrCreate(['wsmn_ukey' => $sm['wsmn_ukey']], $sm);
            $createdSubMenus[$sm['wsmn_ukey']] = $record;
        }

        // Super Admin gets full CRUD + visibility on every submenu
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


        $this->command->info('Admin seeder completed!');
        $this->command->table(
            ['Role', 'Email', 'Password'],
            [
                ['Super Admin', 'admin@no1.com', '123456'],
            ]
        );
    }
}
