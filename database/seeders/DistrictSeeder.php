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
            ['division' => 'Dhaka', 'name' => 'Dhaka', 'name_bn' => 'ঢাকা', 'code' => 'DHA'],
            ['division' => 'Dhaka', 'name' => 'Gazipur', 'name_bn' => 'গাজীপুর', 'code' => 'GAZ'],
            ['division' => 'Dhaka', 'name' => 'Narayanganj', 'name_bn' => 'নারায়ণগঞ্জ', 'code' => 'NAR'],
            ['division' => 'Dhaka', 'name' => 'Tangail', 'name_bn' => 'টাঙ্গাইল', 'code' => 'TAN'],
            ['division' => 'Dhaka', 'name' => 'Kishoreganj', 'name_bn' => 'কিশোরগঞ্জ', 'code' => 'KIS'],
            ['division' => 'Dhaka', 'name' => 'Manikganj', 'name_bn' => 'মানিকগঞ্জ', 'code' => 'MAN'],
            ['division' => 'Dhaka', 'name' => 'Munshiganj', 'name_bn' => 'মুন্সিগঞ্জ', 'code' => 'MUN'],
            ['division' => 'Dhaka', 'name' => 'Narsingdi', 'name_bn' => 'নরসিংদী', 'code' => 'NAR'],
            ['division' => 'Dhaka', 'name' => 'Faridpur', 'name_bn' => 'ফরিদপুর', 'code' => 'FAR'],
            ['division' => 'Dhaka', 'name' => 'Rajbari', 'name_bn' => 'রাজবাড়ী', 'code' => 'RAJ'],
            ['division' => 'Dhaka', 'name' => 'Shariatpur', 'name_bn' => 'শরীয়তপুর', 'code' => 'SHA'],
            ['division' => 'Dhaka', 'name' => 'Madaripur', 'name_bn' => 'মাদারীপুর', 'code' => 'MAD'],
            ['division' => 'Dhaka', 'name' => 'Gopalganj', 'name_bn' => 'গোপালগঞ্জ', 'code' => 'GOP'],
            
            // Chittagong Division
            ['division' => 'Chittagong', 'name' => 'Chittagong', 'name_bn' => 'চট্টগ্রাম', 'code' => 'CHI'],
            ['division' => 'Chittagong', 'name' => 'Cox\'s Bazar', 'name_bn' => 'কক্সবাজার', 'code' => 'COX'],
            ['division' => 'Chittagong', 'name' => 'Comilla', 'name_bn' => 'কুমিল্লা', 'code' => 'COM'],
            ['division' => 'Chittagong', 'name' => 'Feni', 'name_bn' => 'ফেনী', 'code' => 'FEN'],
            ['division' => 'Chittagong', 'name' => 'Noakhali', 'name_bn' => 'নোয়াখালী', 'code' => 'NOA'],
            ['division' => 'Chittagong', 'name' => 'Lakshmipur', 'name_bn' => 'লক্ষ্মীপুর', 'code' => 'LAK'],
            ['division' => 'Chittagong', 'name' => 'Chandpur', 'name_bn' => 'চাঁদপুর', 'code' => 'CHA'],
            ['division' => 'Chittagong', 'name' => 'Brahmanbaria', 'name_bn' => 'ব্রাহ্মণবাড়িয়া', 'code' => 'BRA'],
            ['division' => 'Chittagong', 'name' => 'Rangamati', 'name_bn' => 'রাঙ্গামাটি', 'code' => 'RAN'],
            ['division' => 'Chittagong', 'name' => 'Bandarban', 'name_bn' => 'বান্দরবান', 'code' => 'BAN'],
            ['division' => 'Chittagong', 'name' => 'Khagrachari', 'name_bn' => 'খাগড়াছড়ি', 'code' => 'KHA'],
            
            // Rajshahi Division
            ['division' => 'Rajshahi', 'name' => 'Rajshahi', 'name_bn' => 'রাজশাহী', 'code' => 'RAJ'],
            ['division' => 'Rajshahi', 'name' => 'Bogra', 'name_bn' => 'বগুড়া', 'code' => 'BOG'],
            ['division' => 'Rajshahi', 'name' => 'Chapai Nawabganj', 'name_bn' => 'চাঁপাই নবাবগঞ্জ', 'code' => 'CHA'],
            ['division' => 'Rajshahi', 'name' => 'Naogaon', 'name_bn' => 'নওগাঁ', 'code' => 'NAO'],
            ['division' => 'Rajshahi', 'name' => 'Natore', 'name_bn' => 'নাটোর', 'code' => 'NAT'],
            ['division' => 'Rajshahi', 'name' => 'Pabna', 'name_bn' => 'পাবনা', 'code' => 'PAB'],
            ['division' => 'Rajshahi', 'name' => 'Sirajganj', 'name_bn' => 'সিরাজগঞ্জ', 'code' => 'SIR'],
            ['division' => 'Rajshahi', 'name' => 'Joypurhat', 'name_bn' => 'জয়পুরহাট', 'code' => 'JOY'],
            
            // Khulna Division
            ['division' => 'Khulna', 'name' => 'Khulna', 'name_bn' => 'খুলনা', 'code' => 'KHU'],
            ['division' => 'Khulna', 'name' => 'Bagerhat', 'name_bn' => 'বাগেরহাট', 'code' => 'BAG'],
            ['division' => 'Khulna', 'name' => 'Satkhira', 'name_bn' => 'সাতক্ষীরা', 'code' => 'SAT'],
            ['division' => 'Khulna', 'name' => 'Jessore', 'name_bn' => 'যশোর', 'code' => 'JES'],
            ['division' => 'Khulna', 'name' => 'Jhenaidah', 'name_bn' => 'ঝিনাইদহ', 'code' => 'JHE'],
            ['division' => 'Khulna', 'name' => 'Magura', 'name_bn' => 'মাগুরা', 'code' => 'MAG'],
            ['division' => 'Khulna', 'name' => 'Narail', 'name_bn' => 'নড়াইল', 'code' => 'NAR'],
            ['division' => 'Khulna', 'name' => 'Kushtia', 'name_bn' => 'কুষ্টিয়া', 'code' => 'KUS'],
            ['division' => 'Khulna', 'name' => 'Chuadanga', 'name_bn' => 'চুয়াডাঙ্গা', 'code' => 'CHU'],
            ['division' => 'Khulna', 'name' => 'Meherpur', 'name_bn' => 'মেহেরপুর', 'code' => 'MEH'],
            
            // Barisal Division
            ['division' => 'Barisal', 'name' => 'Barisal', 'name_bn' => 'বরিশাল', 'code' => 'BAR'],
            ['division' => 'Barisal', 'name' => 'Barguna', 'name_bn' => 'বরগুনা', 'code' => 'BRG'],
            ['division' => 'Barisal', 'name' => 'Patuakhali', 'name_bn' => 'পটুয়াখালী', 'code' => 'PAT'],
            ['division' => 'Barisal', 'name' => 'Bhola', 'name_bn' => 'ভোলা', 'code' => 'BHO'],
            ['division' => 'Barisal', 'name' => 'Pirojpur', 'name_bn' => 'পিরোজপুর', 'code' => 'PIR'],
            ['division' => 'Barisal', 'name' => 'Jhalokati', 'name_bn' => 'ঝালকাঠি', 'code' => 'JHA'],
            
            // Sylhet Division
            ['division' => 'Sylhet', 'name' => 'Sylhet', 'name_bn' => 'সিলেট', 'code' => 'SYL'],
            ['division' => 'Sylhet', 'name' => 'Moulvibazar', 'name_bn' => 'মৌলভীবাজার', 'code' => 'MOU'],
            ['division' => 'Sylhet', 'name' => 'Habiganj', 'name_bn' => 'হবিগঞ্জ', 'code' => 'HAB'],
            ['division' => 'Sylhet', 'name' => 'Sunamganj', 'name_bn' => 'সুনামগঞ্জ', 'code' => 'SUN'],
            
            // Rangpur Division
            ['division' => 'Rangpur', 'name' => 'Rangpur', 'name_bn' => 'রংপুর', 'code' => 'RAN'],
            ['division' => 'Rangpur', 'name' => 'Dinajpur', 'name_bn' => 'দিনাজপুর', 'code' => 'DIN'],
            ['division' => 'Rangpur', 'name' => 'Kurigram', 'name_bn' => 'কুড়িগ্রাম', 'code' => 'KUR'],
            ['division' => 'Rangpur', 'name' => 'Gaibandha', 'name_bn' => 'গাইবান্ধা', 'code' => 'GAI'],
            ['division' => 'Rangpur', 'name' => 'Lalmonirhat', 'name_bn' => 'লালমনিরহাট', 'code' => 'LAL'],
            ['division' => 'Rangpur', 'name' => 'Nilphamari', 'name_bn' => 'নীলফামারী', 'code' => 'NIL'],
            ['division' => 'Rangpur', 'name' => 'Panchagarh', 'name_bn' => 'পঞ্চগড়', 'code' => 'PAN'],
            ['division' => 'Rangpur', 'name' => 'Thakurgaon', 'name_bn' => 'ঠাকুরগাঁও', 'code' => 'THA'],
            
            // Mymensingh Division
            ['division' => 'Mymensingh', 'name' => 'Mymensingh', 'name_bn' => 'ময়মনসিংহ', 'code' => 'MYM'],
            ['division' => 'Mymensingh', 'name' => 'Jamalpur', 'name_bn' => 'জামালপুর', 'code' => 'JAM'],
            ['division' => 'Mymensingh', 'name' => 'Netrokona', 'name_bn' => 'নেত্রকোণা', 'code' => 'NET'],
            ['division' => 'Mymensingh', 'name' => 'Sherpur', 'name_bn' => 'শেরপুর', 'code' => 'SHE'],
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