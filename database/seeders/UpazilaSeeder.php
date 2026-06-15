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
                 // Dhaka District (Upazilas: 7)
            ['district' => 'Dhaka', 'name' => 'Dhamrai', 'name_bn' => 'ধামরাই', 'code' => 'DHA07'],
            ['district' => 'Dhaka', 'name' => 'Dohar', 'name_bn' => 'দোহার', 'code' => 'DHA08'],
            ['district' => 'Dhaka', 'name' => 'Keraniganj', 'name_bn' => 'কেরানীগঞ্জ', 'code' => 'DHA09'],
            ['district' => 'Dhaka', 'name' => 'Nawabganj', 'name_bn' => 'নবাবগঞ্জ', 'code' => 'DHA10'],
            ['district' => 'Dhaka', 'name' => 'Savar', 'name_bn' => 'সাভার', 'code' => 'DHA11'],
            // The following are city corporation areas, sometimes listed separately
            ['district' => 'Dhaka', 'name' => 'Dhaka Sadar', 'name_bn' => 'ঢাকা সদর', 'code' => 'DHA01'],
            ['district' => 'Dhaka', 'name' => 'Tejgaon', 'name_bn' => 'তেজগাঁও', 'code' => 'DHA12'],

            // Gazipur District (Upazilas: 5)
            ['district' => 'Gazipur', 'name' => 'Gazipur Sadar', 'name_bn' => 'গাজীপুর সদর', 'code' => 'GAZ01'],
            ['district' => 'Gazipur', 'name' => 'Kaliakair', 'name_bn' => 'কালিয়াকৈর', 'code' => 'GAZ02'],
            ['district' => 'Gazipur', 'name' => 'Kaliganj', 'name_bn' => 'কালীগঞ্জ', 'code' => 'GAZ03'],
            ['district' => 'Gazipur', 'name' => 'Kapasia', 'name_bn' => 'কাপাসিয়া', 'code' => 'GAZ04'],
            ['district' => 'Gazipur', 'name' => 'Sreepur', 'name_bn' => 'শ্রীপুর', 'code' => 'GAZ05'],

            // Narsingdi District (Upazilas: 6)
            ['district' => 'Narsingdi', 'name' => 'Narsingdi Sadar', 'name_bn' => 'নরসিংদী সদর', 'code' => 'NAR01'],
            ['district' => 'Narsingdi', 'name' => 'Belabo', 'name_bn' => 'বেলাবো', 'code' => 'NAR02'],
            ['district' => 'Narsingdi', 'name' => 'Monohardi', 'name_bn' => 'মনোহরদী', 'code' => 'NAR03'],
            ['district' => 'Narsingdi', 'name' => 'Palash', 'name_bn' => 'পলাশ', 'code' => 'NAR04'],
            ['district' => 'Narsingdi', 'name' => 'Raipura', 'name_bn' => 'রায়পুরা', 'code' => 'NAR05'],
            ['district' => 'Narsingdi', 'name' => 'Shibpur', 'name_bn' => 'শিবপুর', 'code' => 'NAR06'],

            // Manikganj District (Upazilas: 7)
            ['district' => 'Manikganj', 'name' => 'Manikganj Sadar', 'name_bn' => 'মানিকগঞ্জ সদর', 'code' => 'MAN01'],
            ['district' => 'Manikganj', 'name' => 'Daulatpur', 'name_bn' => 'দৌলতপুর', 'code' => 'MAN02'],
            ['district' => 'Manikganj', 'name' => 'Ghior', 'name_bn' => 'ঘিওর', 'code' => 'MAN03'],
            ['district' => 'Manikganj', 'name' => 'Harirampur', 'name_bn' => 'হরিরামপুর', 'code' => 'MAN04'],
            ['district' => 'Manikganj', 'name' => 'Saturia', 'name_bn' => 'সাটুরিয়া', 'code' => 'MAN05'],
            ['district' => 'Manikganj', 'name' => 'Shibalaya', 'name_bn' => 'শিবালয়', 'code' => 'MAN06'],
            ['district' => 'Manikganj', 'name' => 'Singair', 'name_bn' => 'সিঙ্গাইর', 'code' => 'MAN07'],

            // Munshiganj District (Upazilas: 6)
            ['district' => 'Munshiganj', 'name' => 'Munshiganj Sadar', 'name_bn' => 'মুন্সীগঞ্জ সদর', 'code' => 'MUN01'],
            ['district' => 'Munshiganj', 'name' => 'Gazaria', 'name_bn' => 'গজারিয়া', 'code' => 'MUN02'],
            ['district' => 'Munshiganj', 'name' => 'Lohajang', 'name_bn' => 'লোহাজং', 'code' => 'MUN03'],
            ['district' => 'Munshiganj', 'name' => 'Sreenagar', 'name_bn' => 'শ্রীনগর', 'code' => 'MUN05'],
            ['district' => 'Munshiganj', 'name' => 'Sirajdikhan', 'name_bn' => 'সিরাজদিখান', 'code' => 'MUN04'],
            ['district' => 'Munshiganj', 'name' => 'Tongibari', 'name_bn' => 'টংগিবাড়ী', 'code' => 'MUN06'],

            // Narayanganj District (Upazilas: 5)
            ['district' => 'Narayanganj', 'name' => 'Narayanganj Sadar', 'name_bn' => 'নারায়ণগঞ্জ সদর', 'code' => 'NAR01'],
            ['district' => 'Narayanganj', 'name' => 'Araihazar', 'name_bn' => 'আড়াইহাজার', 'code' => 'NAR02'],
            ['district' => 'Narayanganj', 'name' => 'Bandar', 'name_bn' => 'বন্দর', 'code' => 'NAR03'],
            ['district' => 'Narayanganj', 'name' => 'Rupganj', 'name_bn' => 'রূপগঞ্জ', 'code' => 'NAR04'],
            ['district' => 'Narayanganj', 'name' => 'Sonargaon', 'name_bn' => 'সোনারগাঁও', 'code' => 'NAR05'],

            // Mymensingh Division Note:
            // The districts of Mymensingh, Sherpur, Jamalpur, Netrokona, and Kishoreganj
            // were historically part of Dhaka Division but now form their own division (Mymensingh Division since 2015)[citation:3][citation:5].
            // They are therefore NOT included in the modern Dhaka Division upazila list.
            // This seeder only includes the 13 districts of the current Dhaka Division[citation:5].

            // Faridpur District (Upazilas: 9)
            ['district' => 'Faridpur', 'name' => 'Faridpur Sadar', 'name_bn' => 'ফরিদপুর সদর', 'code' => 'FAR01'],
            ['district' => 'Faridpur', 'name' => 'Alfadanga', 'name_bn' => 'আলফাডাঙ্গা', 'code' => 'FAR02'],
            ['district' => 'Faridpur', 'name' => 'Bhanga', 'name_bn' => 'ভাঙ্গা', 'code' => 'FAR03'],
            ['district' => 'Faridpur', 'name' => 'Boalmari', 'name_bn' => 'বোয়ালমারী', 'code' => 'FAR04'],
            ['district' => 'Faridpur', 'name' => 'Charbhadrasan', 'name_bn' => 'চরভদ্রাসন', 'code' => 'FAR05'],
            ['district' => 'Faridpur', 'name' => 'Madhukhali', 'name_bn' => 'মধুখালী', 'code' => 'FAR06'],
            ['district' => 'Faridpur', 'name' => 'Nagarkanda', 'name_bn' => 'নগরকান্দা', 'code' => 'FAR07'],
            ['district' => 'Faridpur', 'name' => 'Sadarpur', 'name_bn' => 'সদরপুর', 'code' => 'FAR08'],
            ['district' => 'Faridpur', 'name' => 'Saltha', 'name_bn' => 'সালথা', 'code' => 'FAR09'],

            // Gopalganj District (Upazilas: 5)
            ['district' => 'Gopalganj', 'name' => 'Gopalganj Sadar', 'name_bn' => 'গোপালগঞ্জ সদর', 'code' => 'GOP01'],
            ['district' => 'Gopalganj', 'name' => 'Kashiani', 'name_bn' => 'কাশিয়ানী', 'code' => 'GOP02'],
            ['district' => 'Gopalganj', 'name' => 'Kotalipara', 'name_bn' => 'কোটালীপাড়া', 'code' => 'GOP03'],
            ['district' => 'Gopalganj', 'name' => 'Muksudpur', 'name_bn' => 'মুকসুদপুর', 'code' => 'GOP04'],
            ['district' => 'Gopalganj', 'name' => 'Tungipara', 'name_bn' => 'টুঙ্গিপাড়া', 'code' => 'GOP05'],

            // Madaripur District (Upazilas: 4)
            ['district' => 'Madaripur', 'name' => 'Madaripur Sadar', 'name_bn' => 'মাদারীপুর সদর', 'code' => 'MAD01'],
            ['district' => 'Madaripur', 'name' => 'Kalkini', 'name_bn' => 'কালকিনি', 'code' => 'MAD02'],
            ['district' => 'Madaripur', 'name' => 'Rajoir', 'name_bn' => 'রাজৈর', 'code' => 'MAD03'],
            ['district' => 'Madaripur', 'name' => 'Shibchar', 'name_bn' => 'শিবচর', 'code' => 'MAD04'],

            // Manikganj, Munshiganj, Narayanganj, and Narsingdi have been added above.

            // Rajbari District (Upazilas: 5)
            ['district' => 'Rajbari', 'name' => 'Rajbari Sadar', 'name_bn' => 'রাজবাড়ী সদর', 'code' => 'RAJ01'],
            ['district' => 'Rajbari', 'name' => 'Baliakandi', 'name_bn' => 'বালিয়াকান্দি', 'code' => 'RAJ02'],
            ['district' => 'Rajbari', 'name' => 'Goalandaghat', 'name_bn' => 'গোয়ালন্দঘাট', 'code' => 'RAJ03'],
            ['district' => 'Rajbari', 'name' => 'Kalukhali', 'name_bn' => 'কালুখালী', 'code' => 'RAJ04'],
            ['district' => 'Rajbari', 'name' => 'Pangsha', 'name_bn' => 'পাংশা', 'code' => 'RAJ05'],

            // Shariatpur District (Upazilas: 6)
            ['district' => 'Shariatpur', 'name' => 'Shariatpur Sadar', 'name_bn' => 'শরীয়তপুর সদর', 'code' => 'SHA01'],
            ['district' => 'Shariatpur', 'name' => 'Bhedarganj', 'name_bn' => 'ভেদরগঞ্জ', 'code' => 'SHA02'],
            ['district' => 'Shariatpur', 'name' => 'Damudya', 'name_bn' => 'ডামুড্যা', 'code' => 'SHA03'],
            ['district' => 'Shariatpur', 'name' => 'Gosairhat', 'name_bn' => 'গোসাইরহাট', 'code' => 'SHA04'],
            ['district' => 'Shariatpur', 'name' => 'Jajira', 'name_bn' => 'জাজিরা', 'code' => 'SHA05'],
            ['district' => 'Shariatpur', 'name' => 'Naria', 'name_bn' => 'নড়িয়া', 'code' => 'SHA06'],

            // Tangail District (Upazilas: 12)
            ['district' => 'Tangail', 'name' => 'Tangail Sadar', 'name_bn' => 'টাঙ্গাইল সদর', 'code' => 'TAN01'],
            ['district' => 'Tangail', 'name' => 'Basail', 'name_bn' => 'বাসাইল', 'code' => 'TAN02'],
            ['district' => 'Tangail', 'name' => 'Bhuapur', 'name_bn' => 'ভুয়াপুর', 'code' => 'TAN03'],
            ['district' => 'Tangail', 'name' => 'Delduar', 'name_bn' => 'দেলদুয়ার', 'code' => 'TAN04'],
            ['district' => 'Tangail', 'name' => 'Ghatail', 'name_bn' => 'ঘাটাইল', 'code' => 'TAN05'],
            ['district' => 'Tangail', 'name' => 'Gopalpur', 'name_bn' => 'গোপালপুর', 'code' => 'TAN06'],
            ['district' => 'Tangail', 'name' => 'Kalihati', 'name_bn' => 'কালিহাতী', 'code' => 'TAN07'],
            ['district' => 'Tangail', 'name' => 'Madhupur', 'name_bn' => 'মধুপুর', 'code' => 'TAN08'],
            ['district' => 'Tangail', 'name' => 'Mirzapur', 'name_bn' => 'মির্জাপুর', 'code' => 'TAN09'],
            ['district' => 'Tangail', 'name' => 'Nagarpur', 'name_bn' => 'নাগরপুর', 'code' => 'TAN10'],
            ['district' => 'Tangail', 'name' => 'Sakhipur', 'name_bn' => 'সখিপুর', 'code' => 'TAN11'],
            ['district' => 'Tangail', 'name' => 'Dhanbari', 'name_bn' => 'ধনবাড়ী', 'code' => 'TAN12'],

               // Bandarban District (Upazilas: 7)
            ['district' => 'Bandarban', 'name' => 'Bandarban Sadar', 'name_bn' => 'বান্দরবান সদর', 'code' => 'BAN01'],
            ['district' => 'Bandarban', 'name' => 'Alikadam', 'name_bn' => 'আলীকদম', 'code' => 'BAN02'],
            ['district' => 'Bandarban', 'name' => 'Lama', 'name_bn' => 'লামা', 'code' => 'BAN03'],
            ['district' => 'Bandarban', 'name' => 'Naikhongchhari', 'name_bn' => 'নাইক্ষ্যংছড়ি', 'code' => 'BAN04'],
            ['district' => 'Bandarban', 'name' => 'Rowangchhari', 'name_bn' => 'রোয়াংছড়ি', 'code' => 'BAN05'],
            ['district' => 'Bandarban', 'name' => 'Ruma', 'name_bn' => 'রুমা', 'code' => 'BAN06'],
            ['district' => 'Bandarban', 'name' => 'Thanchi', 'name_bn' => 'থানচি', 'code' => 'BAN07'],

            // Brahmanbaria District (Upazilas: 9)
            ['district' => 'Brahmanbaria', 'name' => 'Brahmanbaria Sadar', 'name_bn' => 'ব্রাহ্মণবাড়িয়া সদর', 'code' => 'BRA01'],
            ['district' => 'Brahmanbaria', 'name' => 'Akhaura', 'name_bn' => 'আখাউড়া', 'code' => 'BRA02'],
            ['district' => 'Brahmanbaria', 'name' => 'Ashuganj', 'name_bn' => 'আশুগঞ্জ', 'code' => 'BRA03'],
            ['district' => 'Brahmanbaria', 'name' => 'Bancharampur', 'name_bn' => 'বাঞ্ছারামপুর', 'code' => 'BRA04'],
            ['district' => 'Brahmanbaria', 'name' => 'Bijoynagar', 'name_bn' => 'বিজয়নগর', 'code' => 'BRA05'],
            ['district' => 'Brahmanbaria', 'name' => 'Kasba', 'name_bn' => 'কসবা', 'code' => 'BRA06'],
            ['district' => 'Brahmanbaria', 'name' => 'Nabinagar', 'name_bn' => 'নবীনগর', 'code' => 'BRA07'],
            ['district' => 'Brahmanbaria', 'name' => 'Nasirnagar', 'name_bn' => 'নাসিরনগর', 'code' => 'BRA08'],
            ['district' => 'Brahmanbaria', 'name' => 'Sarail', 'name_bn' => 'সরাইল', 'code' => 'BRA09'],

            // Chandpur District (Upazilas: 8)
            ['district' => 'Chandpur', 'name' => 'Chandpur Sadar', 'name_bn' => 'চাঁদপুর সদর', 'code' => 'CHA01'],
            ['district' => 'Chandpur', 'name' => 'Faridganj', 'name_bn' => 'ফরিদগঞ্জ', 'code' => 'CHA02'],
            ['district' => 'Chandpur', 'name' => 'Haimchar', 'name_bn' => 'হাইমচর', 'code' => 'CHA03'],
            ['district' => 'Chandpur', 'name' => 'Haziganj', 'name_bn' => 'হাজীগঞ্জ', 'code' => 'CHA04'],
            ['district' => 'Chandpur', 'name' => 'Kachua', 'name_bn' => 'কচুয়া', 'code' => 'CHA05'],
            ['district' => 'Chandpur', 'name' => 'Matlab Uttar', 'name_bn' => 'মতলব উত্তর', 'code' => 'CHA06'],
            ['district' => 'Chandpur', 'name' => 'Matlab Dakshin', 'name_bn' => 'মতলব দক্ষিণ', 'code' => 'CHA07'],
            ['district' => 'Chandpur', 'name' => 'Shahrasti', 'name_bn' => 'শাহরাস্তি', 'code' => 'CHA08'],

            // Chittagong District (Upazilas: 14)
            ['district' => 'Chittagong', 'name' => 'Chittagong Sadar', 'name_bn' => 'চট্টগ্রাম সদর', 'code' => 'CHI01'],
            ['district' => 'Chittagong', 'name' => 'Anwara', 'name_bn' => 'আনোয়ারা', 'code' => 'CHI02'],
            ['district' => 'Chittagong', 'name' => 'Banshkhali', 'name_bn' => 'বাঁশখালী', 'code' => 'CHI03'],
            ['district' => 'Chittagong', 'name' => 'Boalkhali', 'name_bn' => 'বোয়ালখালী', 'code' => 'CHI04'],
            ['district' => 'Chittagong', 'name' => 'Chandanaish', 'name_bn' => 'চন্দনাইশ', 'code' => 'CHI05'],
            ['district' => 'Chittagong', 'name' => 'Fatikchhari', 'name_bn' => 'ফটিকছড়ি', 'code' => 'CHI06'],
            ['district' => 'Chittagong', 'name' => 'Hathazari', 'name_bn' => 'হাটহাজারী', 'code' => 'CHI07'],
            ['district' => 'Chittagong', 'name' => 'Lohagara', 'name_bn' => 'লোহাগাড়া', 'code' => 'CHI08'],
            ['district' => 'Chittagong', 'name' => 'Mirsharai', 'name_bn' => 'মীরসরাই', 'code' => 'CHI09'],
            ['district' => 'Chittagong', 'name' => 'Patiya', 'name_bn' => 'পটিয়া', 'code' => 'CHI10'],
            ['district' => 'Chittagong', 'name' => 'Rangunia', 'name_bn' => 'রাঙ্গুনিয়া', 'code' => 'CHI11'],
            ['district' => 'Chittagong', 'name' => 'Raozan', 'name_bn' => 'রাউজান', 'code' => 'CHI12'],
            ['district' => 'Chittagong', 'name' => 'Sandwip', 'name_bn' => 'সন্দ্বীপ', 'code' => 'CHI13'],
            ['district' => 'Chittagong', 'name' => 'Satkania', 'name_bn' => 'সাতকানিয়া', 'code' => 'CHI14'],
            ['district' => 'Chittagong', 'name' => 'Sitakunda', 'name_bn' => 'সীতাকুণ্ড', 'code' => 'CHI15'],

            // Comilla District (Upazilas: 16)
            ['district' => 'Comilla', 'name' => 'Comilla Sadar', 'name_bn' => 'কুমিল্লা সদর', 'code' => 'COM01'],
            ['district' => 'Comilla', 'name' => 'Barura', 'name_bn' => 'বরুড়া', 'code' => 'COM02'],
            ['district' => 'Comilla', 'name' => 'Brahmanpara', 'name_bn' => 'ব্রাহ্মণপাড়া', 'code' => 'COM03'],
            ['district' => 'Comilla', 'name' => 'Burichang', 'name_bn' => 'বুড়িচং', 'code' => 'COM04'],
            ['district' => 'Comilla', 'name' => 'Chandina', 'name_bn' => 'চান্দিনা', 'code' => 'COM05'],
            ['district' => 'Comilla', 'name' => 'Chauddagram', 'name_bn' => 'চৌদ্দগ্রাম', 'code' => 'COM06'],
            ['district' => 'Comilla', 'name' => 'Daudkandi', 'name_bn' => 'দাউদকান্দি', 'code' => 'COM07'],
            ['district' => 'Comilla', 'name' => 'Debidwar', 'name_bn' => 'দেবিদ্বার', 'code' => 'COM08'],
            ['district' => 'Comilla', 'name' => 'Homna', 'name_bn' => 'হোমনা', 'code' => 'COM09'],
            ['district' => 'Comilla', 'name' => 'Laksam', 'name_bn' => 'লাকসাম', 'code' => 'COM10'],
            ['district' => 'Comilla', 'name' => 'Lalmai', 'name_bn' => 'লালমাই', 'code' => 'COM11'],
            ['district' => 'Comilla', 'name' => 'Manoharganj', 'name_bn' => 'মনোহরগঞ্জ', 'code' => 'COM12'],
            ['district' => 'Comilla', 'name' => 'Meghna', 'name_bn' => 'মেঘনা', 'code' => 'COM13'],
            ['district' => 'Comilla', 'name' => 'Muradnagar', 'name_bn' => 'মুরাদনগর', 'code' => 'COM14'],
            ['district' => 'Comilla', 'name' => 'Nangalkot', 'name_bn' => 'নাঙ্গলকোট', 'code' => 'COM15'],
            ['district' => 'Comilla', 'name' => 'Titas', 'name_bn' => 'তিতাস', 'code' => 'COM16'],

            // Cox's Bazar District (Upazilas: 8)
            ['district' => 'Cox\'s Bazar', 'name' => 'Cox\'s Bazar Sadar', 'name_bn' => 'কক্সবাজার সদর', 'code' => 'COX01'],
            ['district' => 'Cox\'s Bazar', 'name' => 'Chakaria', 'name_bn' => 'চকরিয়া', 'code' => 'COX02'],
            ['district' => 'Cox\'s Bazar', 'name' => 'Eidgaon', 'name_bn' => 'ঈদগাঁও', 'code' => 'COX03'],
            ['district' => 'Cox\'s Bazar', 'name' => 'Kutubdia', 'name_bn' => 'কুতুবদিয়া', 'code' => 'COX04'],
            ['district' => 'Cox\'s Bazar', 'name' => 'Maheshkhali', 'name_bn' => 'মহেশখালী', 'code' => 'COX05'],
            ['district' => 'Cox\'s Bazar', 'name' => 'Ramu', 'name_bn' => 'রামু', 'code' => 'COX06'],
            ['district' => 'Cox\'s Bazar', 'name' => 'Teknaf', 'name_bn' => 'টেকনাফ', 'code' => 'COX07'],
            ['district' => 'Cox\'s Bazar', 'name' => 'Ukhia', 'name_bn' => 'উখিয়া', 'code' => 'COX08'],

            // Feni District (Upazilas: 6)
            ['district' => 'Feni', 'name' => 'Feni Sadar', 'name_bn' => 'ফেনী সদর', 'code' => 'FEN01'],
            ['district' => 'Feni', 'name' => 'Chhagalnaiya', 'name_bn' => 'ছাগলনাইয়া', 'code' => 'FEN02'],
            ['district' => 'Feni', 'name' => 'Daganbhuiyan', 'name_bn' => 'দাগনভূঞা', 'code' => 'FEN03'],
            ['district' => 'Feni', 'name' => 'Parshuram', 'name_bn' => 'পরশুরাম', 'code' => 'FEN04'],
            ['district' => 'Feni', 'name' => 'Sonagazi', 'name_bn' => 'সোনাগাজী', 'code' => 'FEN05'],
            ['district' => 'Feni', 'name' => 'Fulgazi', 'name_bn' => 'ফুলগাজী', 'code' => 'FEN06'],

            // Khagrachhari District (Upazilas: 8)
            ['district' => 'Khagrachhari', 'name' => 'Khagrachhari Sadar', 'name_bn' => 'খাগড়াছড়ি সদর', 'code' => 'KHA01'],
            ['district' => 'Khagrachhari', 'name' => 'Dighinala', 'name_bn' => 'দিঘীনালা', 'code' => 'KHA02'],
            ['district' => 'Khagrachhari', 'name' => 'Lakshmichhari', 'name_bn' => 'লক্ষীছড়ি', 'code' => 'KHA03'],
            ['district' => 'Khagrachhari', 'name' => 'Mahalchhari', 'name_bn' => 'মহালছড়ি', 'code' => 'KHA04'],
            ['district' => 'Khagrachhari', 'name' => 'Manikchhari', 'name_bn' => 'মানিকছড়ি', 'code' => 'KHA05'],
            ['district' => 'Khagrachhari', 'name' => 'Matiranga', 'name_bn' => 'মাটিরাঙ্গা', 'code' => 'KHA06'],
            ['district' => 'Khagrachhari', 'name' => 'Panchhari', 'name_bn' => 'পানছড়ি', 'code' => 'KHA07'],
            ['district' => 'Khagrachhari', 'name' => 'Ramgarh', 'name_bn' => 'রামগড়', 'code' => 'KHA08'],

            // Lakshmipur District (Upazilas: 5)
            ['district' => 'Lakshmipur', 'name' => 'Lakshmipur Sadar', 'name_bn' => 'লক্ষীপুর সদর', 'code' => 'LAK01'],
            ['district' => 'Lakshmipur', 'name' => 'Raipur', 'name_bn' => 'রায়পুর', 'code' => 'LAK02'],
            ['district' => 'Lakshmipur', 'name' => 'Ramganj', 'name_bn' => 'রামগঞ্জ', 'code' => 'LAK03'],
            ['district' => 'Lakshmipur', 'name' => 'Ramgati', 'name_bn' => 'রামগতি', 'code' => 'LAK04'],
            ['district' => 'Lakshmipur', 'name' => 'Kamalnagar', 'name_bn' => 'কমলনগর', 'code' => 'LAK05'],

            // Noakhali District (Upazilas: 9)
            ['district' => 'Noakhali', 'name' => 'Noakhali Sadar', 'name_bn' => 'নোয়াখালী সদর', 'code' => 'NOA01'],
            ['district' => 'Noakhali', 'name' => 'Begumganj', 'name_bn' => 'বেগমগঞ্জ', 'code' => 'NOA02'],
            ['district' => 'Noakhali', 'name' => 'Chatkhil', 'name_bn' => 'চাটখিল', 'code' => 'NOA03'],
            ['district' => 'Noakhali', 'name' => 'Companiganj', 'name_bn' => 'কোম্পানীগঞ্জ', 'code' => 'NOA04'],
            ['district' => 'Noakhali', 'name' => 'Hatiya', 'name_bn' => 'হাতিয়া', 'code' => 'NOA05'],
            ['district' => 'Noakhali', 'name' => 'Senbagh', 'name_bn' => 'সেনবাগ', 'code' => 'NOA06'],
            ['district' => 'Noakhali', 'name' => 'Sonaimuri', 'name_bn' => 'সোনাইমুড়ী', 'code' => 'NOA07'],
            ['district' => 'Noakhali', 'name' => 'Subarnachar', 'name_bn' => 'সুবর্ণচর', 'code' => 'NOA08'],
            ['district' => 'Noakhali', 'name' => 'Kabirhat', 'name_bn' => 'কবিরহাট', 'code' => 'NOA09'],

            // Rangamati District (Upazilas: 10)
            ['district' => 'Rangamati', 'name' => 'Rangamati Sadar', 'name_bn' => 'রাঙ্গামাটি সদর', 'code' => 'RAN01'],
            ['district' => 'Rangamati', 'name' => 'Bagaichhari', 'name_bn' => 'বাঘাইছড়ি', 'code' => 'RAN02'],
            ['district' => 'Rangamati', 'name' => 'Barkal', 'name_bn' => 'বরকল', 'code' => 'RAN03'],
            ['district' => 'Rangamati', 'name' => 'Juraichhari', 'name_bn' => 'জুরাছড়ি', 'code' => 'RAN04'],
            ['district' => 'Rangamati', 'name' => 'Kaptai', 'name_bn' => 'কাপ্তাই', 'code' => 'RAN05'],
            ['district' => 'Rangamati', 'name' => 'Langadu', 'name_bn' => 'লংগদু', 'code' => 'RAN06'],
            ['district' => 'Rangamati', 'name' => 'Naniarchar', 'name_bn' => 'নানিয়ারচর', 'code' => 'RAN07'],
            ['district' => 'Rangamati', 'name' => 'Rajasthali', 'name_bn' => 'রাজস্থলী', 'code' => 'RAN08'],
            ['district' => 'Rangamati', 'name' => 'Belai Chhari', 'name_bn' => 'বিলাইছড়ি', 'code' => 'RAN09'],
            ['district' => 'Rangamati', 'name' => 'Kawkhali (Rangamati)', 'name_bn' => 'কাউখালী', 'code' => 'RAN10'],

               ['district' => 'Barisal', 'name' => 'Barisal Sadar', 'name_bn' => 'বরিশাল সদর', 'code' => 'BAR01'],
            ['district' => 'Barisal', 'name' => 'Agailjhara', 'name_bn' => 'আগৈলঝাড়া', 'code' => 'BAR02'],
            ['district' => 'Barisal', 'name' => 'Babuganj', 'name_bn' => 'বাবুগঞ্জ', 'code' => 'BAR03'],
            ['district' => 'Barisal', 'name' => 'Bakerganj', 'name_bn' => 'বাকেরগঞ্জ', 'code' => 'BAR04'],
            ['district' => 'Barisal', 'name' => 'Banaripara', 'name_bn' => 'বানারীপাড়া', 'code' => 'BAR05'],
            ['district' => 'Barisal', 'name' => 'Gournadi', 'name_bn' => 'গৌরনদী', 'code' => 'BAR06'],
            ['district' => 'Barisal', 'name' => 'Hijla', 'name_bn' => 'হিজলা', 'code' => 'BAR07'],
            ['district' => 'Barisal', 'name' => 'Mehendiganj', 'name_bn' => 'মেহেন্দিগঞ্জ', 'code' => 'BAR08'],
            ['district' => 'Barisal', 'name' => 'Muladi', 'name_bn' => 'মুলাদী', 'code' => 'BAR09'],
            ['district' => 'Barisal', 'name' => 'Wazirpur', 'name_bn' => 'উজিরপুর', 'code' => 'BAR10'],

            // Barguna District (Upazilas: 5)
            ['district' => 'Barguna', 'name' => 'Barguna Sadar', 'name_bn' => 'বরগুনা সদর', 'code' => 'BAG01'],
            ['district' => 'Barguna', 'name' => 'Amtali', 'name_bn' => 'আমতলী', 'code' => 'BAG02'],
            ['district' => 'Barguna', 'name' => 'Bamna', 'name_bn' => 'বামনা', 'code' => 'BAG03'],
            ['district' => 'Barguna', 'name' => 'Betagi', 'name_bn' => 'বেতাগী', 'code' => 'BAG04'],
            ['district' => 'Barguna', 'name' => 'Taltoli', 'name_bn' => 'তালতলী', 'code' => 'BAG05'],

            // Bhola District (Upazilas: 7)
            ['district' => 'Bhola', 'name' => 'Bhola Sadar', 'name_bn' => 'ভোলা সদর', 'code' => 'BHO01'],
            ['district' => 'Bhola', 'name' => 'Burhanuddin', 'name_bn' => 'বোরহানউদ্দিন', 'code' => 'BHO02'],
            ['district' => 'Bhola', 'name' => 'Char Fasson', 'name_bn' => 'চর ফ্যাশন', 'code' => 'BHO03'],
            ['district' => 'Bhola', 'name' => 'Daulatkhan', 'name_bn' => 'দৌলতখান', 'code' => 'BHO04'],
            ['district' => 'Bhola', 'name' => 'Lalmohan', 'name_bn' => 'লালমোহন', 'code' => 'BHO05'],
            ['district' => 'Bhola', 'name' => 'Manpura', 'name_bn' => 'মনপুরা', 'code' => 'BHO06'],
            ['district' => 'Bhola', 'name' => 'Tazumuddin', 'name_bn' => 'তজুমদ্দিন', 'code' => 'BHO07'],

            // Jhalokati District (Upazilas: 4)
            ['district' => 'Jhalokati', 'name' => 'Jhalokati Sadar', 'name_bn' => 'ঝালকাঠি সদর', 'code' => 'JHA01'],
            ['district' => 'Jhalokati', 'name' => 'Kanthalia', 'name_bn' => 'কাঁঠালিয়া', 'code' => 'JHA02'],
            ['district' => 'Jhalokati', 'name' => 'Nalchity', 'name_bn' => 'নলছিটি', 'code' => 'JHA03'],
            ['district' => 'Jhalokati', 'name' => 'Rajapur', 'name_bn' => 'রাজাপুর', 'code' => 'JHA04'],

            // Patuakhali District (Upazilas: 8)
            ['district' => 'Patuakhali', 'name' => 'Patuakhali Sadar', 'name_bn' => 'পটুয়াখালী সদর', 'code' => 'PAT01'],
            ['district' => 'Patuakhali', 'name' => 'Bauphal', 'name_bn' => 'বাউফল', 'code' => 'PAT02'],
            ['district' => 'Patuakhali', 'name' => 'Dashmina', 'name_bn' => 'দশমিনা', 'code' => 'PAT03'],
            ['district' => 'Patuakhali', 'name' => 'Dumki', 'name_bn' => 'দুমকি', 'code' => 'PAT04'],
            ['district' => 'Patuakhali', 'name' => 'Galachipa', 'name_bn' => 'গলাচিপা', 'code' => 'PAT05'],
            ['district' => 'Patuakhali', 'name' => 'Kalapara', 'name_bn' => 'কালাপাড়া', 'code' => 'PAT06'],
            ['district' => 'Patuakhali', 'name' => 'Mirzaganj', 'name_bn' => 'মির্জাগঞ্জ', 'code' => 'PAT07'],
            ['district' => 'Patuakhali', 'name' => 'Rangabali', 'name_bn' => 'রাঙ্গাবালী', 'code' => 'PAT08'],

            // Pirojpur District (Upazilas: 7)
            ['district' => 'Pirojpur', 'name' => 'Pirojpur Sadar', 'name_bn' => 'পিরোজপুর সদর', 'code' => 'PIR01'],
            ['district' => 'Pirojpur', 'name' => 'Bhandaria', 'name_bn' => 'ভান্ডারিয়া', 'code' => 'PIR02'],
            ['district' => 'Pirojpur', 'name' => 'Kawkhali (Pirojpur)', 'name_bn' => 'কাউখালী', 'code' => 'PIR03'],
            ['district' => 'Pirojpur', 'name' => 'Mathbaria', 'name_bn' => 'মঠবাড়িয়া', 'code' => 'PIR04'],
            ['district' => 'Pirojpur', 'name' => 'Nazirpur', 'name_bn' => 'নাজিরপুর', 'code' => 'PIR05'],
            ['district' => 'Pirojpur', 'name' => 'Nesarabad (Swarupkathi)', 'name_bn' => 'নেছারাবাদ (স্বরূপকাঠি)', 'code' => 'PIR06'],
            ['district' => 'Pirojpur', 'name' => 'Zianagar', 'name_bn' => 'জিয়ানগর', 'code' => 'PIR07'],

            

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