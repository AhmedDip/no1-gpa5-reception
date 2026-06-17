<?php
// database/seeders/UpazilaSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Upazila;
use App\Models\District;

class UpazilaSeeder extends Seeder
{
    public function run(): void
    {
        $upazilas = [
            ['district' => 'Dhaka', 'name' => 'Dhamrai', 'name_bn' => 'ধামরাই', 'code' => 'UPA01'],
            ['district' => 'Dhaka', 'name' => 'Dohar', 'name_bn' => 'দোহার', 'code' => 'UPA02'],
            ['district' => 'Dhaka', 'name' => 'Keraniganj', 'name_bn' => 'কেরানীগঞ্জ', 'code' => 'UPA03'],
            ['district' => 'Dhaka', 'name' => 'Nawabganj', 'name_bn' => 'নবাবগঞ্জ', 'code' => 'UPA04'],
            ['district' => 'Dhaka', 'name' => 'Savar', 'name_bn' => 'সাভার', 'code' => 'UPA05'],
            ['district' => 'Dhaka', 'name' => 'Dohar', 'name_bn' => 'দোহার', 'code' => 'UPA06'],
            ['district' => 'Dhaka', 'name' => 'Keraniganj', 'name_bn' => 'কেরানীগঞ্জ', 'code' => 'UPA07'],
          

            // Gazipur District (Upazilas: 5)
            ['district' => 'Gazipur', 'name' => 'Gazipur Sadar', 'name_bn' => 'গাজীপুর সদর', 'code' => 'UPA08'],
            ['district' => 'Gazipur', 'name' => 'Kaliakair', 'name_bn' => 'কালিয়াকৈর', 'code' => 'UPA09'],
            ['district' => 'Gazipur', 'name' => 'Kaliganj', 'name_bn' => 'কালীগঞ্জ', 'code' => 'UPA10'],
            ['district' => 'Gazipur', 'name' => 'Kapasia', 'name_bn' => 'কাপাসিয়া', 'code' => 'UPA11'],
            ['district' => 'Gazipur', 'name' => 'Sreepur', 'name_bn' => 'শ্রীপুর', 'code' => 'UPA12'],

            // Narsingdi District (Upazilas: 6)
            ['district' => 'Narsingdi', 'name' => 'Narsingdi Sadar', 'name_bn' => 'নরসিংদী সদর', 'code' => 'UPA13'],
            ['district' => 'Narsingdi', 'name' => 'Belabo', 'name_bn' => 'বেলাবো', 'code' => 'UPA14'],
            ['district' => 'Narsingdi', 'name' => 'Monohardi', 'name_bn' => 'মনোহরদী', 'code' => 'UPA15'],
            ['district' => 'Narsingdi', 'name' => 'Palash', 'name_bn' => 'পলাশ', 'code' => 'UPA16'],
            ['district' => 'Narsingdi', 'name' => 'Raipura', 'name_bn' => 'রায়পুরা', 'code' => 'UPA17'],
            ['district' => 'Narsingdi', 'name' => 'Shibpur', 'name_bn' => 'শিবপুর', 'code' => 'UPA18'],

            // Manikganj District (Upazilas: 7)
            ['district' => 'Manikganj', 'name' => 'Manikganj Sadar', 'name_bn' => 'মানিকগঞ্জ সদর', 'code' => 'UPA19'],
            ['district' => 'Manikganj', 'name' => 'Daulatpur', 'name_bn' => 'দৌলতপুর', 'code' => 'UPA20'],
            ['district' => 'Manikganj', 'name' => 'Ghior', 'name_bn' => 'ঘিওর', 'code' => 'UPA21'],
            ['district' => 'Manikganj', 'name' => 'Harirampur', 'name_bn' => 'হরিরামপুর', 'code' => 'UPA22'],
            ['district' => 'Manikganj', 'name' => 'Saturia', 'name_bn' => 'সাটুরিয়া', 'code' => 'UPA23'],
            ['district' => 'Manikganj', 'name' => 'Shibalaya', 'name_bn' => 'শিবালয়', 'code' => 'UPA24'],
            ['district' => 'Manikganj', 'name' => 'Singair', 'name_bn' => 'সিঙ্গাইর', 'code' => 'UPA25'],

            // Munshiganj District (Upazilas: 6)
            ['district' => 'Munshiganj', 'name' => 'Munshiganj Sadar', 'name_bn' => 'মুন্সীগঞ্জ সদর', 'code' => 'UPA27'],
            ['district' => 'Munshiganj', 'name' => 'Gazaria', 'name_bn' => 'গজারিয়া', 'code' => 'UPA28'],
            ['district' => 'Munshiganj', 'name' => 'Lohajang', 'name_bn' => 'লোহাজং', 'code' => 'UPA29'],
            ['district' => 'Munshiganj', 'name' => 'Sreenagar', 'name_bn' => 'শ্রীনগর', 'code' => 'UPA30'],
            ['district' => 'Munshiganj', 'name' => 'Sirajdikhan', 'name_bn' => 'সিরজদিখান', 'code' => 'UPA31'],
            ['district' => 'Munshiganj', 'name' => 'Tongibari', 'name_bn' => 'টংগিবাড়ী', 'code' => 'UPA32'],

            // Narayanganj District (Upazilas: 5)
            ['district' => 'Narayanganj', 'name' => 'Narayanganj Sadar', 'name_bn' => 'নারায়ণগঞ্জ সদর', 'code' => 'UPA26'],
            ['district' => 'Narayanganj', 'name' => 'Araihazar', 'name_bn' => 'আড়াইহাজার', 'code' => 'UPA33'],
            ['district' => 'Narayanganj', 'name' => 'Bandar', 'name_bn' => 'বন্দর', 'code' => 'UPA34'],
            ['district' => 'Narayanganj', 'name' => 'Rupganj', 'name_bn' => 'রূপগঞ্জ', 'code' => 'UPA35'],
            ['district' => 'Narayanganj', 'name' => 'Sonargaon', 'name_bn' => 'সোনারগাঁও', 'code' => 'UPA36'],

            // Mymensingh Division Note:
            // The districts of Mymensingh, Sherpur, Jamalpur, Netrokona, and Kishoreganj
            // were historically part of Dhaka Division but now form their own division (Mymensingh Division since 2015)[citation:3][citation:5].
            // They are therefore NOT included in the modern Dhaka Division upazila list.
            // This seeder only includes the 13 districts of the current Dhaka Division[citation:5].

            // Faridpur District (Upazilas: 9)
            ['district' => 'Faridpur', 'name' => 'Faridpur Sadar', 'name_bn' => 'ফরিদপুর সদর', 'code' => 'UPA37'],
            ['district' => 'Faridpur', 'name' => 'Alfadanga', 'name_bn' => 'আলফাডাঙ্গা', 'code' => 'UPA38'],
            ['district' => 'Faridpur', 'name' => 'Bhanga', 'name_bn' => 'ভাঙ্গা', 'code' => 'UPA39'],
            ['district' => 'Faridpur', 'name' => 'Boalmari', 'name_bn' => 'বোয়ালমারী', 'code' => 'UPA40'],
            ['district' => 'Faridpur', 'name' => 'Charbhadrasan', 'name_bn' => 'চরভদ্রাসন', 'code' => 'UPA41'],
            ['district' => 'Faridpur', 'name' => 'Madhukhali', 'name_bn' => 'মধুখালী', 'code' => 'UPA42'],
            ['district' => 'Faridpur', 'name' => 'Nagarkanda', 'name_bn' => 'নগরকান্দা', 'code' => 'UPA43'],
            ['district' => 'Faridpur', 'name' => 'Sadarpur', 'name_bn' => 'সদরপুর', 'code' => 'UPA44'],
            ['district' => 'Faridpur', 'name' => 'Saltha', 'name_bn' => 'সালথা', 'code' => 'UPA45'],

            // Gopalganj District (Upazilas: 5)
            ['district' => 'Gopalganj', 'name' => 'Gopalganj Sadar', 'name_bn' => 'গোপালগঞ্জ সদর', 'code' => 'UPA46'],
            ['district' => 'Gopalganj', 'name' => 'Kashiani', 'name_bn' => 'কাশিয়ানী', 'code' => 'UPA47'],
            ['district' => 'Gopalganj', 'name' => 'Kotalipara', 'name_bn' => 'কোটালীপাড়া', 'code' => 'UPA48'],
            ['district' => 'Gopalganj', 'name' => 'Muksudpur', 'name_bn' => 'মুকসুদপুর', 'code' => 'UPA49'],
            ['district' => 'Gopalganj', 'name' => 'Tungipara', 'name_bn' => 'টুঙ্গিপাড়া', 'code' => 'UPA50'],

            // Madaripur District (Upazilas: 4)
            ['district' => 'Madaripur', 'name' => 'Madaripur Sadar', 'name_bn' => 'মাদারীপুর সদর', 'code' => 'UPA51'],
            ['district' => 'Madaripur', 'name' => 'Kalkini', 'name_bn' => 'কালকিনি', 'code' => 'UPA52'],
            ['district' => 'Madaripur', 'name' => 'Rajoir', 'name_bn' => 'রাজৈর', 'code' => 'UPA53'],
            ['district' => 'Madaripur', 'name' => 'Shibchar', 'name_bn' => 'শিবচর', 'code' => 'UPA54'],

            // Manikganj, Munshiganj, Narayanganj, and Narsingdi have been added above.

            // Rajbari District (Upazilas: 5)
            ['district' => 'Rajbari', 'name' => 'Rajbari Sadar', 'name_bn' => 'রাজবাড়ী সদর', 'code' => 'UPA55'],
            ['district' => 'Rajbari', 'name' => 'Baliakandi', 'name_bn' => 'বালিয়াকান্দি', 'code' => 'UPA56'],
            ['district' => 'Rajbari', 'name' => 'Goalandaghat', 'name_bn' => 'গোয়ালন্দঘাট', 'code' => 'UPA57'],
            ['district' => 'Rajbari', 'name' => 'Kalukhali', 'name_bn' => 'কালুখালী', 'code' => 'UPA58'],
            ['district' => 'Rajbari', 'name' => 'Pangsha', 'name_bn' => 'পাংশা', 'code' => 'UPA59'],

            // Shariatpur District (Upazilas: 6)
            ['district' => 'Shariatpur', 'name' => 'Shariatpur Sadar', 'name_bn' => 'শরীয়তপুর সদর', 'code' => 'UPA60'],
            ['district' => 'Shariatpur', 'name' => 'Bhedarganj', 'name_bn' => 'ভেদরগঞ্জ', 'code' => 'UPA61'],
            ['district' => 'Shariatpur', 'name' => 'Damudya', 'name_bn' => 'ডামুড্যা', 'code' => 'UPA62'],
            ['district' => 'Shariatpur', 'name' => 'Gosairhat', 'name_bn' => 'গোসাইরহাট', 'code' => 'UPA63'],
            ['district' => 'Shariatpur', 'name' => 'Jajira', 'name_bn' => 'জাজিরা', 'code' => 'UPA64'],
            ['district' => 'Shariatpur', 'name' => 'Naria', 'name_bn' => 'নড়িয়া', 'code' => 'UPA65'],

            // Tangail District (Upazilas: 12)
            ['district' => 'Tangail', 'name' => 'Tangail Sadar', 'name_bn' => 'টাঙ্গাইল সদর', 'code' => 'UPA66'],
            ['district' => 'Tangail', 'name' => 'Basail', 'name_bn' => 'বাসাইল', 'code' => 'UPA67'],
            ['district' => 'Tangail', 'name' => 'Bhuapur', 'name_bn' => 'ভুয়াপুর', 'code' => 'UPA68'],
            ['district' => 'Tangail', 'name' => 'Delduar', 'name_bn' => 'দেলদুয়ার', 'code' => 'UPA69'],
            ['district' => 'Tangail', 'name' => 'Ghatail', 'name_bn' => 'ঘাটাইল', 'code' => 'UPA70'],
            ['district' => 'Tangail', 'name' => 'Gopalpur', 'name_bn' => 'গোপালপুর', 'code' => 'UPA71'],
            ['district' => 'Tangail', 'name' => 'Kalihati', 'name_bn' => 'কালিহাতী', 'code' => 'UPA72'],
            ['district' => 'Tangail', 'name' => 'Madhupur', 'name_bn' => 'মধুপুর', 'code' => 'UPA73'],
            ['district' => 'Tangail', 'name' => 'Mirzapur', 'name_bn' => 'মির্জাপুর', 'code' => 'UPA74'],
            ['district' => 'Tangail', 'name' => 'Nagarpur', 'name_bn' => 'নাগরপুর', 'code' => 'UPA75'],
            ['district' => 'Tangail', 'name' => 'Sakhipur', 'name_bn' => 'সখিপুর', 'code' => 'UPA76'],
            ['district' => 'Tangail', 'name' => 'Dhanbari', 'name_bn' => 'ধনবাড়ী', 'code' => 'UPA77'],

               // Bandarban District (Upazilas: 7)
            ['district' => 'Bandarban', 'name' => 'Bandarban Sadar', 'name_bn' => 'বান্দরবান সদর', 'code' => 'UPA78'],
            ['district' => 'Bandarban', 'name' => 'Alikadam', 'name_bn' => 'আলীকদম', 'code' => 'UPA79'],
            ['district' => 'Bandarban', 'name' => 'Lama', 'name_bn' => 'লামা', 'code' => 'UPA80'],
            ['district' => 'Bandarban', 'name' => 'Naikhongchhari', 'name_bn' => 'নাইক্ষ্যংছড়ি', 'code' => 'UPA81'],
            ['district' => 'Bandarban', 'name' => 'Rowangchhari', 'name_bn' => 'রোয়াংছড়ি', 'code' => 'UPA82'],
            ['district' => 'Bandarban', 'name' => 'Ruma', 'name_bn' => 'রুমা', 'code' => 'UPA83'],
            ['district' => 'Bandarban', 'name' => 'Thanchi', 'name_bn' => 'থানচি', 'code' => 'UPA84'],

            // Brahmanbaria District (Upazilas: 9)
            ['district' => 'Brahmanbaria', 'name' => 'Brahmanbaria Sadar', 'name_bn' => 'ব্রাহ্মণবাড়িয়া সদর', 'code' => 'UPA85'],
            ['district' => 'Brahmanbaria', 'name' => 'Akhaura', 'name_bn' => 'আখাউড়া', 'code' => 'UPA86'],
            ['district' => 'Brahmanbaria', 'name' => 'Ashuganj', 'name_bn' => 'আশুগঞ্জ', 'code' => 'UPA87'],
            ['district' => 'Brahmanbaria', 'name' => 'Bancharampur', 'name_bn' => 'বাঞ্ছারামপুর', 'code' => 'UPA88'],
            ['district' => 'Brahmanbaria', 'name' => 'Bijoynagar', 'name_bn' => 'বিজয়নগর', 'code' => 'UPA89'],
            ['district' => 'Brahmanbaria', 'name' => 'Kasba', 'name_bn' => 'কসবা', 'code' => 'UPA90'],
            ['district' => 'Brahmanbaria', 'name' => 'Nasirnagar', 'name_bn' => 'নাসিরনগর', 'code' => 'UPA91'],
            ['district' => 'Brahmanbaria', 'name' => 'Sarail', 'name_bn' => 'সরাইল', 'code' => 'UPA92'],

            // Chandpur District (Upazilas: 8)
            ['district' => 'Chandpur', 'name' => 'Chandpur Sadar', 'name_bn' => 'চাঁদপুর সদর', 'code' => 'UPA93'],
            ['district' => 'Chandpur', 'name' => 'Faridganj', 'name_bn' => 'ফরিদগঞ্জ', 'code' => 'UPA94'],
            ['district' => 'Chandpur', 'name' => 'Haimchar', 'name_bn' => 'হাইমচর', 'code' => 'UPA95'],
            ['district' => 'Chandpur', 'name' => 'Haziganj', 'name_bn' => 'হাজীগঞ্জ', 'code' => 'UPA96'],
            ['district' => 'Chandpur', 'name' => 'Kachua', 'name_bn' => 'কচুয়া', 'code' => 'UPA97'],
            ['district' => 'Chandpur', 'name' => 'Matlab Uttar', 'name_bn' => 'মতলব উত্তর', 'code' => 'UPA98'],
            ['district' => 'Chandpur', 'name' => 'Matlab Dakshin', 'name_bn' => 'মতলব দক্ষিণ', 'code' => 'UPA99'],
            ['district' => 'Chandpur', 'name' => 'Shahrasti', 'name_bn' => 'শাহরাস্তি', 'code' => 'UPA100'],

            // Chittagong District (Upazilas: 14)
            ['district' => 'Chittagong', 'name' => 'Chittagong Sadar', 'name_bn' => 'চট্টগ্রাম সদর', 'code' => 'UPA101'],
            ['district' => 'Chittagong', 'name' => 'Anwara', 'name_bn' => 'আনোয়ারা', 'code' => 'UPA102'],
            ['district' => 'Chittagong', 'name' => 'Banshkhali', 'name_bn' => 'বাঁশখালী', 'code' => 'UPA103'],
            ['district' => 'Chittagong', 'name' => 'Boalkhali', 'name_bn' => 'বোয়ালখালী', 'code' => 'UPA104'],
            ['district' => 'Chittagong', 'name' => 'Chandanaish', 'name_bn' => 'চন্দনাইশ', 'code' => 'UPA105'],
            ['district' => 'Chittagong', 'name' => 'Fatikchhari', 'name_bn' => 'ফটিকছড়ি', 'code' => 'UPA106'],
            ['district' => 'Chittagong', 'name' => 'Hathazari', 'name_bn' => 'হাটহাজারী', 'code' => 'UPA107'],
            ['district' => 'Chittagong', 'name' => 'Raozan', 'name_bn' => 'রাউজান', 'code' => 'UPA108'],
            ['district' => 'Chittagong', 'name' => 'Sandwip', 'name_bn' => 'সন্দ্বীপ', 'code' => 'UPA109'],
            ['district' => 'Chittagong', 'name' => 'Satkania', 'name_bn' => 'সাতকানিয়া', 'code' => 'UPA110'],
            ['district' => 'Chittagong', 'name' => 'Sitakunda', 'name_bn' => 'সীতাকুণ্ড', 'code' => 'UPA111'],
            ['district' => 'Chittagong', 'name' => 'Mirsharai', 'name_bn' => 'মিরসরাই', 'code' => 'UPA112'],
            ['district' => 'Chittagong', 'name' => 'Patiya', 'name_bn' => 'পটিয়া', 'code' => 'UPA113'],
            ['district' => 'Chittagong', 'name' => 'Rangunia', 'name_bn' => 'রাঙ্গুনিয়া', 'code' => 'UPA114'],


            // Comilla District (Upazilas: 16)
            ['district' => 'Comilla', 'name' => 'Comilla Sadar', 'name_bn' => 'কুমিল্লা সদর', 'code' => 'UPA115'],
            ['district' => 'Comilla', 'name' => 'Barura', 'name_bn' => 'বরুড়া', 'code' => 'UPA116'],
            ['district' => 'Comilla', 'name' => 'Brahmanpara', 'name_bn' => 'ব্রাহ্মণপাড়া', 'code' => 'UPA117'],
            ['district' => 'Comilla', 'name' => 'Burichang', 'name_bn' => 'বুড়িচং', 'code' => 'UPA118'],
            ['district' => 'Comilla', 'name' => 'Chandina', 'name_bn' => 'চান্দিনা', 'code' => 'UPA119'],
            ['district' => 'Comilla', 'name' => 'Chauddagram', 'name_bn' => 'চৌদ্দগ্রাম', 'code' => 'UPA120'],
            ['district' => 'Comilla', 'name' => 'Daudkandi', 'name_bn' => 'দাউদকান্দি', 'code' => 'UPA121'],
            ['district' => 'Comilla', 'name' => 'Debidwar', 'name_bn' => 'দেবিদ্বার', 'code' => 'UPA122'],
            ['district' => 'Comilla', 'name' => 'Homna', 'name_bn' => 'হোমনা', 'code' => 'UPA123'],
            ['district' => 'Comilla', 'name' => 'Laksam', 'name_bn' => 'লাকসাম', 'code' => 'UPA124'],
            ['district' => 'Comilla', 'name' => 'Lalmai', 'name_bn' => 'লালমাই', 'code' => 'UPA125'],
            ['district' => 'Comilla', 'name' => 'Manoharganj', 'name_bn' => 'মনোহরগঞ্জ', 'code' => 'UPA126'],
            ['district' => 'Comilla', 'name' => 'Meghna', 'name_bn' => 'মেঘনা', 'code' => 'UPA127'],
            ['district' => 'Comilla', 'name' => 'Muradnagar', 'name_bn' => 'মুরাদনগর', 'code' => 'UPA128'],
            ['district' => 'Comilla', 'name' => 'Nangalkot', 'name_bn' => 'নাঙ্গলকোট', 'code' => 'UPA129'],


            // Cox's Bazar District (Upazilas: 8)
            ['district' => 'Cox\'s Bazar', 'name' => 'Cox\'s Bazar Sadar', 'name_bn' => 'কক্সবাজার সদর', 'code' => 'UPA130'],
            ['district' => 'Cox\'s Bazar', 'name' => 'Chakaria', 'name_bn' => 'চকরিয়া', 'code' => 'UPA131'],
            ['district' => 'Cox\'s Bazar', 'name' => 'Eidgaon', 'name_bn' => 'ঈদগাঁও', 'code' => 'UPA132'],
            ['district' => 'Cox\'s Bazar', 'name' => 'Kutubdia', 'name_bn' => 'কুতুবদিয়া', 'code' => 'UPA133'],
            ['district' => 'Cox\'s Bazar', 'name' => 'Maheshkhali', 'name_bn' => 'মহেশখালী', 'code' => 'UPA134'],
            ['district' => 'Cox\'s Bazar', 'name' => 'Ramu', 'name_bn' => 'রামু', 'code' => 'UPA135'],
            ['district' => 'Cox\'s Bazar', 'name' => 'Teknaf', 'name_bn' => 'টেকনাফ', 'code' => 'UPA136'],
            ['district' => 'Cox\'s Bazar', 'name' => 'Ukhia', 'name_bn' => 'উখিয়া', 'code' => 'UPA137'],

            // Feni District (Upazilas: 6)
            ['district' => 'Feni', 'name' => 'Feni Sadar', 'name_bn' => 'ফেনী সদর', 'code' => 'UPA138'],
            ['district' => 'Feni', 'name' => 'Chhagalnaiya', 'name_bn' => 'ছাগলনাইয়া', 'code' => 'UPA139'],
            ['district' => 'Feni', 'name' => 'Daganbhuiyan', 'name_bn' => 'দাগনভূঞা', 'code' => 'UPA140'],
            ['district' => 'Feni', 'name' => 'Parshuram', 'name_bn' => 'পরশুরাম', 'code' => 'UPA141'],
            ['district' => 'Feni', 'name' => 'Sonagazi', 'name_bn' => 'সোনাগাজী', 'code' => 'UPA142'],
            ['district' => 'Feni', 'name' => 'Fulgazi', 'name_bn' => 'ফুলগাজী', 'code' => 'UPA143'],

            // Khagrachhari District (Upazilas: 8)
            ['district' => 'Khagrachhari', 'name' => 'Khagrachhari Sadar', 'name_bn' => 'খাগড়াছড়ি সদর', 'code' => 'UPA144'],
            ['district' => 'Khagrachhari', 'name' => 'Dighinala', 'name_bn' => 'দিঘীনালা', 'code' => 'UPA145'],
            ['district' => 'Khagrachhari', 'name' => 'Lakshmichhari', 'name_bn' => 'লক্ষীছড়ি', 'code' => 'UPA146'],
            ['district' => 'Khagrachhari', 'name' => 'Mahalchhari', 'name_bn' => 'মহালছড়ি', 'code' => 'UPA147'],
            ['district' => 'Khagrachhari', 'name' => 'Manikchhari', 'name_bn' => 'মানিকছড়ি', 'code' => 'UPA148'],
            ['district' => 'Khagrachhari', 'name' => 'Matiranga', 'name_bn' => 'মাটিরাঙ্গা', 'code' => 'UPA149'],
            ['district' => 'Khagrachhari', 'name' => 'Panchhari', 'name_bn' => 'পানছড়ি', 'code' => 'UPA150'],
            ['district' => 'Khagrachhari', 'name' => 'Ramgarh', 'name_bn' => 'রামগড়', 'code' => 'UPA151'],

            // Lakshmipur District (Upazilas: 5)
            ['district' => 'Lakshmipur', 'name' => 'Lakshmipur Sadar', 'name_bn' => 'লক্ষীপুর সদর', 'code' => 'UPA152'],
            ['district' => 'Lakshmipur', 'name' => 'Raipur', 'name_bn' => 'রায়পুর', 'code' => 'UPA153'],
            ['district' => 'Lakshmipur', 'name' => 'Ramganj', 'name_bn' => 'রামগঞ্জ', 'code' => 'UPA154'],
            ['district' => 'Lakshmipur', 'name' => 'Ramgati', 'name_bn' => 'রামগতি', 'code' => 'UPA155'],
            ['district' => 'Lakshmipur', 'name' => 'Kamalnagar', 'name_bn' => 'কমলনগর', 'code' => 'UPA156'],
            // Noakhali District (Upazilas: 9)
            ['district' => 'Noakhali', 'name' => 'Noakhali Sadar', 'name_bn' => 'নোয়াখালী সদর', 'code' => 'UPA157'],
            ['district' => 'Noakhali', 'name' => 'Begumganj', 'name_bn' => 'বেগমগঞ্জ', 'code' => 'UPA158'],
            ['district' => 'Noakhali', 'name' => 'Chatkhil', 'name_bn' => 'চাটখিল', 'code' => 'UPA159'],
            ['district' => 'Noakhali', 'name' => 'Companiganj', 'name_bn' => 'কোম্পানীগঞ্জ', 'code' => 'UPA160'],
            ['district' => 'Noakhali', 'name' => 'Hatiya', 'name_bn' => 'হাতিয়া', 'code' => 'UPA161'],
            ['district' => 'Noakhali', 'name' => 'Senbagh', 'name_bn' => 'সেনবাগ', 'code' => 'UPA162'],
            ['district' => 'Noakhali', 'name' => 'Sonaimuri', 'name_bn' => 'সোনাইমুড়ী', 'code' => 'UPA163'],
            ['district' => 'Noakhali', 'name' => 'Subarnachar', 'name_bn' => 'সুবর্ণচর', 'code' => 'UPA164'],
            ['district' => 'Noakhali', 'name' => 'Kabirhat', 'name_bn' => 'কবিরহাট', 'code' => 'UPA165'],

            // Rangamati District (Upazilas: 10)
            ['district' => 'Rangamati', 'name' => 'Rangamati Sadar', 'name_bn' => 'রাঙ্গামাটি সদর', 'code' => 'UPA166'],
            ['district' => 'Rangamati', 'name' => 'Bagaichhari', 'name_bn' => 'বাঘাইছড়ি', 'code' => 'UPA167'],
            ['district' => 'Rangamati', 'name' => 'Barkal', 'name_bn' => 'বরকল', 'code' => 'UPA168'],
            ['district' => 'Rangamati', 'name' => 'Juraichhari', 'name_bn' => 'জুরাছড়ি', 'code' => 'UPA169'],
            ['district' => 'Rangamati', 'name' => 'Kaptai', 'name_bn' => 'কাপ্তাই', 'code' => 'UPA170'],
            ['district' => 'Rangamati', 'name' => 'Kawkhali (Rangamati)', 'name_bn' => 'কাউখালী', 'code' => 'UPA171'],
            ['district' => 'Rangamati', 'name' => 'Langadu', 'name_bn' => 'লংগদু', 'code' => 'UPA172'],
            ['district' => 'Rangamati', 'name' => 'Naniarchar', 'name_bn' => 'নানিয়ারচর', 'code' => 'UPA173'],
            ['district' => 'Rangamati', 'name' => 'Rajasthali', 'name_bn' => 'রাজস্থলী', 'code' => 'UPA174'],

            ['district' => 'Rangamati', 'name' => 'Belai Chhari', 'name_bn' => 'বিলাইছড়ি', 'code' => 'UPA175'],
            ['district' => 'Rangamati', 'name' => 'Kawkhali (Rangamati)', 'name_bn' => 'কাউখালী', 'code' => 'UPA176'],

            ['district' => 'Barisal', 'name' => 'Barisal Sadar', 'name_bn' => 'বরিশাল সদর', 'code' => 'UPA177'],
            ['district' => 'Barisal', 'name' => 'Agailjhara', 'name_bn' => 'আগৈলঝাড়া', 'code' => 'UPA178'],
            ['district' => 'Barisal', 'name' => 'Babuganj', 'name_bn' => 'বাবুগঞ্জ', 'code' => 'UPA179'],
            ['district' => 'Barisal', 'name' => 'Bakerganj', 'name_bn' => 'বাকেরগঞ্জ', 'code' => 'UPA180'],
            ['district' => 'Barisal', 'name' => 'Banaripara', 'name_bn' => 'বানারীপাড়া', 'code' => 'UPA181'],
            ['district' => 'Barisal', 'name' => 'Gournadi', 'name_bn' => 'গৌরনদী', 'code' => 'UPA182'],
            ['district' => 'Barisal', 'name' => 'Hijla', 'name_bn' => 'হিজলা', 'code' => 'UPA183'],
            ['district' => 'Barisal', 'name' => 'Mehendiganj', 'name_bn' => 'মেহেন্দিগঞ্জ', 'code' => 'UPA184'],
            ['district' => 'Barisal', 'name' => 'Muladi', 'name_bn' => 'মুলাদী', 'code' => 'UPA185'],
            ['district' => 'Barisal', 'name' => 'Wazirpur', 'name_bn' => 'উজিরপুর', 'code' => 'UPA186'],

            // Barguna District (Upazilas: 5)
            ['district' => 'Barguna', 'name' => 'Barguna Sadar', 'name_bn' => 'বরগুনা সদর', 'code' => 'UPA187'],
            ['district' => 'Barguna', 'name' => 'Amtali', 'name_bn' => 'আমতলী', 'code' => 'UPA188'],
            ['district' => 'Barguna', 'name' => 'Bamna', 'name_bn' => 'বামনা', 'code' => 'UPA189'],
            ['district' => 'Barguna', 'name' => 'Betagi', 'name_bn' => 'বেতাগী', 'code' => 'UPA190'],
            ['district' => 'Barguna', 'name' => 'Taltoli', 'name_bn' => 'তালতলী', 'code' => 'UPA191'],

            // Bhola District (Upazilas: 7)
            ['district' => 'Bhola', 'name' => 'Bhola Sadar', 'name_bn' => 'ভোলা সদর', 'code' => 'UPA192'],
            ['district' => 'Bhola', 'name' => 'Burhanuddin', 'name_bn' => 'বোরহানউদ্দিন', 'code' => 'UPA193'],
            ['district' => 'Bhola', 'name' => 'Char Fasson', 'name_bn' => 'চর ফ্যাশন', 'code' => 'UPA194'],
            ['district' => 'Bhola', 'name' => 'Daulatkhan', 'name_bn' => 'দৌলতখান', 'code' => 'UPA195'],
            ['district' => 'Bhola', 'name' => 'Lalmohan', 'name_bn' => 'লালমোহন', 'code' => 'UPA196'],
            ['district' => 'Bhola', 'name' => 'Manpura', 'name_bn' => 'মনপুরা', 'code' => 'UPA197'],
            ['district' => 'Bhola', 'name' => 'Tazumuddin', 'name_bn' => 'তজুমদ্দিন', 'code' => 'UPA198'],

            // Jhalokati District (Upazilas: 4)
            ['district' => 'Jhalokati', 'name' => 'Jhalokati Sadar', 'name_bn' => 'ঝালকাঠি সদর', 'code' => 'UPA199'],
            ['district' => 'Jhalokati', 'name' => 'Kanthalia', 'name_bn' => 'কাঁঠালিয়া', 'code' => 'UPA200'],
            ['district' => 'Jhalokati', 'name' => 'Nalchity', 'name_bn' => 'নলছিটি', 'code' => 'UPA201'],
            ['district' => 'Jhalokati', 'name' => 'Rajapur', 'name_bn' => 'রাজাপুর', 'code' => 'UPA202'],

            // Patuakhali District (Upazilas: 8)
            ['district' => 'Patuakhali', 'name' => 'Patuakhali Sadar', 'name_bn' => 'পটুয়াখালী সদর', 'code' => 'UPA203'],
            ['district' => 'Patuakhali', 'name' => 'Bauphal', 'name_bn' => 'বাউফল', 'code' => 'UPA204'],
            ['district' => 'Patuakhali', 'name' => 'Dashmina', 'name_bn' => 'দশমিনা', 'code' => 'UPA205'],
            ['district' => 'Patuakhali', 'name' => 'Dumki', 'name_bn' => 'দুমকি', 'code' => 'UPA206'],
            ['district' => 'Patuakhali', 'name' => 'Galachipa', 'name_bn' => 'গলাচিপা', 'code' => 'UPA207'],
            ['district' => 'Patuakhali', 'name' => 'Kalapara', 'name_bn' => 'কালাপাড়া', 'code' => 'UPA208'],
            ['district' => 'Patuakhali', 'name' => 'Mirzaganj', 'name_bn' => 'মির্জাগঞ্জ', 'code' => 'UPA209'],
            ['district' => 'Patuakhali', 'name' => 'Rangabali', 'name_bn' => 'রাঙ্গাবালী', 'code' => 'UPA210'],

            // Pirojpur District (Upazilas: 7)
            ['district' => 'Pirojpur', 'name' => 'Pirojpur Sadar', 'name_bn' => 'পিরোজপুর সদর', 'code' => 'UPA211'],
            ['district' => 'Pirojpur', 'name' => 'Bhandaria', 'name_bn' => 'ভান্ডারিয়া', 'code' => 'UPA212'],
            ['district' => 'Pirojpur', 'name' => 'Kawkhali (Pirojpur)', 'name_bn' => 'কাউখালী', 'code' => 'UPA213'],
            ['district' => 'Pirojpur', 'name' => 'Mathbaria', 'name_bn' => 'মঠবাড়িয়া', 'code' => 'UPA214'],
            ['district' => 'Pirojpur', 'name' => 'Nazirpur', 'name_bn' => 'নাজিরপুর', 'code' => 'UPA215'],
            ['district' => 'Pirojpur', 'name' => 'Nesarabad (Swarupkathi)', 'name_bn' => 'নেছারাবাদ (স্বরূপকাঠি)', 'code' => 'UPA216'],
            ['district' => 'Pirojpur', 'name' => 'Zianagar', 'name_bn' => 'জিয়ানগর', 'code' => 'UPA217'],
            


        ];

        foreach ($upazilas as $upazila) {
            $district = District::where('name', $upazila['district'])->first();
            if ($district) {
                Upazila::create([
                    'district_id' => $district->id,
                    'name' => $upazila['name'],
                    'name_bn' => $upazila['name_bn'],
                    'code' => $upazila['code'],
                ]);
            }
        }
    }
}