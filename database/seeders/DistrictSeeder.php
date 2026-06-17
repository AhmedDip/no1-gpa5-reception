<?php
// database/seeders/DistrictSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\District;
use App\Models\Division;

class DistrictSeeder extends Seeder
{
    public function run(): void
    {
        $districts = [
            // Dhaka Division
            ['division' => 'Dhaka', 'name' => 'Dhaka', 'name_bn' => 'ঢাকা', 'code' => 'DSCT001'],
            ['division' => 'Dhaka', 'name' => 'Gazipur', 'name_bn' => 'গাজীপুর', 'code' => 'DSCT002'],
            ['division' => 'Dhaka', 'name' => 'Narayanganj', 'name_bn' => 'নারায়ণগঞ্জ', 'code' => 'DSCT003'],
            ['division' => 'Dhaka', 'name' => 'Tangail', 'name_bn' => 'টাঙ্গাইল', 'code' => 'DSCT004'],
            ['division' => 'Dhaka', 'name' => 'Kishoreganj', 'name_bn' => 'কিশোরগঞ্জ', 'code' => 'DSCT005'],
            ['division' => 'Dhaka', 'name' => 'Manikganj', 'name_bn' => 'মানিকগঞ্জ', 'code' => 'DSCT006'],
            ['division' => 'Dhaka', 'name' => 'Munshiganj', 'name_bn' => 'মুন্সিগঞ্জ', 'code' => 'DSCT007'],
            ['division' => 'Dhaka', 'name' => 'Narsingdi', 'name_bn' => 'নরসিংদী', 'code' => 'DSCT008'],
            ['division' => 'Dhaka', 'name' => 'Faridpur', 'name_bn' => 'ফরিদপুর', 'code' => 'DSCT009'],
            ['division' => 'Dhaka', 'name' => 'Rajbari', 'name_bn' => 'রাজবাড়ী', 'code' => 'DSCT010'],
            ['division' => 'Dhaka', 'name' => 'Shariatpur', 'name_bn' => 'শরীয়তপুর', 'code' => 'DSCT011'],
            ['division' => 'Dhaka', 'name' => 'Madaripur', 'name_bn' => 'মাদারীপুর', 'code' => 'DSCT012'],
            ['division' => 'Dhaka', 'name' => 'Gopalganj', 'name_bn' => 'গোপালগঞ্জ', 'code' => 'DSCT013'],

            // Chittagong Division
            ['division' => 'Chittagong', 'name' => 'Chittagong', 'name_bn' => 'চট্টগ্রাম', 'code' => 'DSCT014'],
            ['division' => 'Chittagong', 'name' => 'Cox\'s Bazar', 'name_bn' => 'কক্সবাজার', 'code' => 'DSCT015'],
            ['division' => 'Chittagong', 'name' => 'Comilla', 'name_bn' => 'কুমিল্লা', 'code' => 'DSCT016'],
            ['division' => 'Chittagong', 'name' => 'Feni', 'name_bn' => 'ফেনী', 'code' => 'DSCT017'],
            ['division' => 'Chittagong', 'name' => 'Noakhali', 'name_bn' => 'নোয়াখালী', 'code' => 'DSCT018'],
            ['division' => 'Chittagong', 'name' => 'Lakshmipur', 'name_bn' => 'লক্ষ্মীপুর', 'code' => 'DSCT019'],
            ['division' => 'Chittagong', 'name' => 'Chandpur', 'name_bn' => 'চাঁদপুর', 'code' => 'DSCT020'],
            ['division' => 'Chittagong', 'name' => 'Brahmanbaria', 'name_bn' => 'ব্রাহ্মণবাড়িয়া', 'code' => 'DSCT021'],
            ['division' => 'Chittagong', 'name' => 'Rangamati', 'name_bn' => 'রাঙ্গামাটি', 'code' => 'DSCT022'],
            ['division' => 'Chittagong', 'name' => 'Bandarban', 'name_bn' => 'বান্দরবান', 'code' => 'DSCT023'],
            ['division' => 'Chittagong', 'name' => 'Khagrachari', 'name_bn' => 'খাগড়াছড়ি', 'code' => 'DSCT024'],
            
            // Rajshahi Division
            ['division' => 'Rajshahi', 'name' => 'Rajshahi', 'name_bn' => 'রাজশাহী', 'code' => 'DSCT025'],
            ['division' => 'Rajshahi', 'name' => 'Bogra', 'name_bn' => 'বগুড়া', 'code' => 'DSCT026'],
            ['division' => 'Rajshahi', 'name' => 'Naogaon', 'name_bn' => 'নওগাঁ', 'code' => 'DSCT027'],
            ['division' => 'Rajshahi', 'name' => 'Natore', 'name_bn' => 'নাটোর', 'code' => 'DSCT028'],
            ['division' => 'Rajshahi', 'name' => 'Pabna', 'name_bn' => 'পাবনা', 'code' => 'DSCT029'],
            ['division' => 'Rajshahi', 'name' => 'Sirajganj', 'name_bn' => 'সিরাজগঞ্জ', 'code' => 'DSCT030'],
            ['division' => 'Rajshahi', 'name' => 'Joypurhat', 'name_bn' => 'জয়পুরহাট', 'code' => 'DSCT031'],
            ['division' => 'Rajshahi', 'name' => 'Chapainawabganj', 'name_bn' => 'চাঁপাইনবাবগঞ্জ', 'code' => 'DSCT032'],
            ['division' => 'Rajshahi', 'name' => 'Puthia', 'name_bn' => 'পুঠিয়া', 'code' => 'DSCT033'],
            
            // Khulna Division
            ['division' => 'Khulna', 'name' => 'Khulna', 'name_bn' => 'খুলনা', 'code' => 'DSCT034'],
            ['division' => 'Khulna', 'name' => 'Bagerhat', 'name_bn' => 'বাগেরহাট', 'code' => 'DSCT035'],
            ['division' => 'Khulna', 'name' => 'Satkhira', 'name_bn' => 'সাতক্ষীরা', 'code' => 'DSCT036'],
            ['division' => 'Khulna', 'name' => 'Jessore', 'name_bn' => 'যশোর', 'code' => 'DSCT037'],
            ['division' => 'Khulna', 'name' => 'Jhenaidah', 'name_bn' => 'ঝিনাইদহ', 'code' => 'DSCT038'],
            ['division' => 'Khulna', 'name' => 'Magura', 'name_bn' => 'মাগুরা', 'code' => 'DSCT039'],
            ['division' => 'Khulna', 'name' => 'Narail', 'name_bn' => 'নড়াইল', 'code' => 'DSCT040'],
            ['division' => 'Khulna', 'name' => 'Kushtia', 'name_bn' => 'কুষ্টিয়া', 'code' => 'DSCT041'],
            ['division' => 'Khulna', 'name' => 'Chuadanga', 'name_bn' => 'চুয়াডাঙ্গা', 'code' => 'DSCT042'],
            ['division' => 'Khulna', 'name' => 'Meherpur', 'name_bn' => 'মেহেরপুর', 'code' => 'DSCT043'],
            
            // Barisal Division
            ['division' => 'Barisal', 'name' => 'Barisal', 'name_bn' => 'বরিশাল', 'code' => 'DSCT044'],
            ['division' => 'Barisal', 'name' => 'Barguna', 'name_bn' => 'বরগুনা', 'code' => 'DSCT045'],
            ['division' => 'Barisal', 'name' => 'Patuakhali', 'name_bn' => 'পটুয়াখালী', 'code' => 'DSCT046'],
            ['division' => 'Barisal', 'name' => 'Bhola', 'name_bn' => 'ভোলা', 'code' => 'DSCT047'],
            ['division' => 'Barisal', 'name' => 'Pirojpur', 'name_bn' => 'পিরোজপুর', 'code' => 'DSCT048'],
            ['division' => 'Barisal', 'name' => 'Jhalokati', 'name_bn' => 'ঝালকাঠি', 'code' => 'DSCT049'],
            
            // Sylhet Division
            ['division' => 'Sylhet', 'name' => 'Sylhet', 'name_bn' => 'সিলেট', 'code' => 'DSCT050'],
            ['division' => 'Sylhet', 'name' => 'Moulvibazar', 'name_bn' => 'মৌলভীবাজার', 'code' => 'DSCT051'],
            ['division' => 'Sylhet', 'name' => 'Habiganj', 'name_bn' => 'হবিগঞ্জ', 'code' => 'DSCT052'],
            ['division' => 'Sylhet', 'name' => 'Sunamganj', 'name_bn' => 'সুনামগঞ্জ', 'code' => 'DSCT053'],
            
            // Rangpur Division
            ['division' => 'Rangpur', 'name' => 'Rangpur', 'name_bn' => 'রংপুর', 'code' => 'DSCT054'],
            ['division' => 'Rangpur', 'name' => 'Dinajpur', 'name_bn' => 'দিনাজপুর', 'code' => 'DSCT055'],
            ['division' => 'Rangpur', 'name' => 'Kurigram', 'name_bn' => 'কুড়িগ্রাম', 'code' => 'DSCT056'],
            ['division' => 'Rangpur', 'name' => 'Gaibandha', 'name_bn' => 'গাইবান্ধা', 'code' => 'DSCT057'],
            ['division' => 'Rangpur', 'name' => 'Lalmonirhat', 'name_bn' => 'লালমনিরহাট', 'code' => 'DSCT058'],
            ['division' => 'Rangpur', 'name' => 'Nilphamari', 'name_bn' => 'নীলফামারী', 'code' => 'DSCT059'],
            ['division' => 'Rangpur', 'name' => 'Panchagarh', 'name_bn' => 'পঞ্চগড়', 'code' => 'DSCT060'],
            ['division' => 'Rangpur', 'name' => 'Thakurgaon', 'name_bn' => 'ঠাকুরগাঁও', 'code' => 'DSCT061'],
            // Mymensingh Division
            ['division' => 'Mymensingh', 'name' => 'Mymensingh', 'name_bn' => 'ময়মনসিংহ', 'code' => 'DSCT062'],
            ['division' => 'Mymensingh', 'name' => 'Jamalpur', 'name_bn' => 'জামালপুর', 'code' => 'DSCT063'],
            ['division' => 'Mymensingh', 'name' => 'Netrokona', 'name_bn' => 'নেত্রকোণা', 'code' => 'DSCT064'],
            ['division' => 'Mymensingh', 'name' => 'Sherpur', 'name_bn' => 'শেরপুর', 'code' => 'DSCT065'],
        ];

        foreach ($districts as $district) {
            $division = Division::where('name', $district['division'])->first();
            if ($division) {
                District::create([
                    'division_id' => $division->id,
                    'name' => $district['name'],
                    'name_bn' => $district['name_bn'],
                    'code' => $district['code'],
                ]);
            }
        }
    }
}