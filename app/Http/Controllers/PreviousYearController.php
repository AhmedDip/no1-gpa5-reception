<?php

namespace App\Http\Controllers;

class PreviousYearController extends Controller
{
    public function index()
    {
        $photos = [
            ['year' => "২০২৫", 'src' => asset('images/gallery/2025/1.jpg'),  'caption' => 'সংবর্ধনা অনুষ্ঠান, ঢাকা'],
            ['year' => "২০২৫", 'src' => asset('images/gallery/2025/4.JPG'),  'caption' => 'সংবর্ধনা অনুষ্ঠানের দৃশ্য'],
            ['year' => "২০২৫", 'src' => asset('images/gallery/2025/2.jpg'),  'caption' => 'ক্রেস্ট বিতরণ মুহূর্ত'],
            ['year' => "২০২৫", 'src' => asset('images/gallery/2025/11.JPG'), 'caption' => 'সংবর্ধনা অনুষ্ঠানের মুহূর্ত'],
            ['year' => "২০২৫", 'src' => asset('images/gallery/2025/14.JPG'), 'caption' => 'সংবর্ধনা অনুষ্ঠানের মুহূর্ত'],
            ['year' => "২০২৫", 'src' => asset('images/gallery/2025/5.jpg'),  'caption' => 'কৃতी শিক্ষার্থীদের অভিভাবকদের সংবর্ধনা'],
            ['year' => "২০২৫", 'src' => asset('images/gallery/2025/6.JPG'),  'caption' => 'সংবর্ধনা অনুষ্ঠানের মুহূর্ত'],
            ['year' => "২০২৫", 'src' => asset('images/gallery/2025/7.JPG'),  'caption' => 'কৃতী শিক্ষার্থীদের সংবর্ধনা'],
            ['year' => "২০২৫", 'src' => asset('images/gallery/2025/10.JPG'), 'caption' => 'সংবর্ধনা অনুষ্ঠানের মুহূর্ত'],
            ['year' => "২০২৫", 'src' => asset('images/gallery/2025/12.JPG'), 'caption' => 'সংবর্ধনা অনুষ্ঠানের দৃশ্য'],
            ['year' => "২০২৫", 'src' => asset('images/gallery/2025/13.JPG'), 'caption' => 'কৃতী শিক্ষার্থীদের অভিভাবকদের সংবর্ধনা'],
            ['year' => "২০২৫", 'src' => asset('images/gallery/2025/15.JPG'), 'caption' => 'কৃতী শিক্ষার্থীদের সংবর্ধনা'],
            ['year' => "২০২৫", 'src' => asset('images/gallery/2025/16.JPG'), 'caption' => 'সংবর্ধনা অনুষ্ঠানের দৃশ্য'],
            ['year' => "২০২৫", 'src' => asset('images/gallery/2025/17.JPG'), 'caption' => 'কৃতী শিক্ষার্থীদের অভিভাবকদের সংবর্ধনা'],
            ['year' => "২০২৫", 'src' => asset('images/gallery/2025/18.jpg'), 'caption' => 'সংবর্ধনা অনুষ্ঠানের মুহূর্ত'],
            ['year' => "২০২৫", 'src' => asset('images/gallery/2025/19.JPG'), 'caption' => 'কৃতী শিক্ষার্থীদের সংবর্ধনা'],
            ['year' => "২০২৫", 'src' => asset('images/gallery/2025/20.JPG'), 'caption' => 'সংবর্ধনা অনুষ্ঠানের দৃশ্য'],
            ['year' => "২০২৫", 'src' => asset('images/gallery/2025/21.JPG'), 'caption' => 'কৃতী শিক্ষার্থীদের অভিভাবকদের সংবর্ধনা'],
            ['year' => "২০২৫", 'src' => asset('images/gallery/2025/22.JPG'), 'caption' => 'সংবর্ধনা অনুষ্ঠানের মুহূর্ত'],
            ['year' => "২০২৫", 'src' => asset('images/gallery/2025/23.JPG'), 'caption' => 'কৃতী শিক্ষার্থীদের সংবর্ধনা'],
            ['year' => "২০২৫", 'src' => asset('images/gallery/2025/24.JPG'), 'caption' => 'সংবর্ধনা অনুষ্ঠানের দৃশ্য'],
            ['year' => "২০২৫", 'src' => asset('images/gallery/2025/25.JPG'), 'caption' => 'কৃতী শিক্ষার্থীদের অভিভাবকদের সংবর্ধনা'],
            ['year' => "২০২৫", 'src' => asset('images/gallery/2025/3.jpg'),  'caption' => 'কৃতী শিক্ষার্থীদের সংবর্ধনা'],
            ['year' => "২০২৪", 'src' => asset('images/gallery/2024/9.JPG'), 'caption' => 'সংবর্ধনা অনুষ্ঠানের দৃশ্য'],
            ['year' => "২০২৪", 'src' => asset('images/gallery/2024/10.JPG'), 'caption' => 'সংবর্ধনা অনুষ্ঠানের দৃশ্য'],
            ['year' => "২০২৪", 'src' => asset('images/gallery/2024/11.JPG'), 'caption' => 'সংবর্ধনা অনুষ্ঠানের দৃশ্য'],
            ['year' => "২০২৪", 'src' => asset('images/gallery/2024/12.JPG'), 'caption' => 'সংবর্ধনা অনুষ্ঠানের দৃশ্য'],
            ['year' => "২০২৪", 'src' => asset('images/gallery/2024/13.JPG'), 'caption' => 'সংবর্ধনা অনুষ্ঠানের দৃশ্য'],
        ];

        $videos = [
            ['year' => "২০২৫", 'id' => 'FN70yEkHFlY', 'title' => 'ঢাকা বিভাগীয় সংবর্ধনা ২০২৫',      'thumbnail' => asset('images/thumbnail/thumb-1.jpg')],
            ['year' => "২০২৫", 'id' => '6ji8FHWegpU', 'title' => 'কৃতী শিক্ষার্থীদের অনুভূতি ২০২৫',    'thumbnail' => asset('images/thumbnail/thumb-3.jpg')],
            ['year' => "২০২৫", 'id' => '5Dtj-bUegMY', 'title' => 'সংবর্ধনা হাইলাইটস ২০২৫',            'thumbnail' => asset('images/thumbnail/thumb-2.jpg')],
            ['year' => "২০২৫", 'id' => '1558RuFY4D4', 'title' => 'কৃতী শিক্ষার্থীদের অনুভূতি ২০২৫',    'thumbnail' => asset('images/thumbnail/thumb-5.png')],
            ['year' => "২০২৫", 'id' => 'cm0n089vPDM', 'title' => 'ঢাকা বিভাগীয় সংবর্ধনা ২০২৫',      'thumbnail' => asset('images/thumbnail/thumb-6.jpg')],
            ['year' => "২০২৫", 'id' => 'QDJ2-roC3Zs', 'title' => 'ঢাকা বিভাগীয় সংবর্ধনা ২০২৫',      'thumbnail' => asset('images/thumbnail/thumb-7.jpg')],
            ['year' => "২০২৫", 'id' => 'NyCj_Ku4tqg', 'title' => 'ঢাকা বিভাগীয় সংবর্ধনা ২০২৫',      'thumbnail' => asset('images/thumbnail/thumb-8.png')],
            ['year' => "২০২৫", 'id' => 'Ygc2yRAkhTU', 'title' => 'ঢাকা বিভাগীয় সংবর্ধনা ২০২৫',      'thumbnail' => asset('images/thumbnail/thumb-9.png')],
            ['year' => "২০২৫", 'id' => 'bqGGZS_QQSc', 'title' => 'ঢাকা বিভাগীয় সংবর্ধনা ২০২৫',      'thumbnail' => asset('images/thumbnail/thumb-10.png')],
        ];

        $newsList = [
            ['year' => "২০২৫", 'title' => 'মেঘনা গ্রুপের আয়োজনে ৬৫ শিক্ষার্থীকে জিপিএ ৫ প্রাপ্তিতে সংবর্ধনা', 'date' => '৩০ আগস্ট ২০২৫ | ১৬:০৭', 'image' => asset('images/news/1.jpg'), 'excerpt' => 'কৃতি সন্তান ও তাদের পরিবারকে সম্মাননা দিল ‘নাম্বার ওয়ান’ ব্র্যান্ড', 'link' => 'https://www.youtube.com/watch?v=T1aFaQ4WGvM'],
            ['year' => "২০২৫", 'title' => 'কৃতি সন্তান ও তাদের পরিবারকে সম্মাননা দিল ‘নাম্বার ওয়ান’ ব্র্যান্ড', 'date' => '৩১ আগস্ট ২০২৫ | ১৬:০৭', 'image' => asset('images/news/1.jpg'), 'excerpt' => 'কৃতি সন্তান ও তাদের পরিবারকে সম্মাননা দিল ‘নাম্বার ওয়ান’ ব্র্যান্ড', 'link' => 'https://samakal.com/economics/article/313356'],
            ['year' => "২০২৫", 'title' => 'চায়ের দোকানদারদের মেধাবী সন্তানদের সম্মাননা দিল ‘নাম্বার ওয়ান ব্র্যান্ড’', 'date' => '৩১ আগস্ট ২০২৫, ২০:৩২', 'image' => asset('images/news/4.jpg'), 'excerpt' => 'প্রতিবারের মত এবারও দেশের প্রান্তিক পর্যায়ের চায়ের দোকানদারদের মেধাবী সন্তান ও তাদের পরিবারকে সম্মাননা দিল মেঘনা গ্রুপের জনপ্রিয় ব্র্যান্ড ‘নাম্বার ওয়ান’।', 'link' => 'https://www.ittefaq.com.bd/749754'],
            ['year' => "২০২৫", 'title' => 'নাম্বার ওয়ান বাবার কৃতী সন্তান সংবর্ধনা ২০২৫ সফলভাবে সম্পন্ন', 'date' => '৩০ আগস্ট ২০২৫, ১০:১৮', 'image' => asset('images/news/4.jpg'), 'excerpt' => 'প্রতিবারের মতো এবারও দেশের প্রান্তিক পর্যায়ের চায়ের দোকানদারদের মেধাবী সন্তান ও তাদের পরিবারকে সম্মাননা দিল মেঘনা গ্রুপের জনপ্রিয় ব্র্যান্ড ‘নাম্বার ওয়ান’', 'link' => 'https://www.kalbela.com/corporate/218378'],
            ['year' => "২০২৫", 'title' => 'নাম্বার ওয়ান বাবার কৃতী সন্তান সংবর্ধনা ২০২৫ সফলভাবে সম্পন্ন', 'date' => '৩০ আগস্ট ২০২৫, ১০:১৮', 'image' => asset('images/news/1.jpg'), 'excerpt' => 'প্রতিবারের মতো এবারও দেশের প্রান্তিক পর্যায়ের চায়ের দোকানদারদের মেধাবী সন্তান ও তাদের পরিবারকে সম্মাননা দিল মেঘনা গ্রুপের জনপ্রিয় ব্র্যান্ড ‘নাম্বার ওয়ান’', 'link' => 'https://www.dainikamadershomoy.com/details/019901302e4a'],
            ['year' => "২০২৪", 'title' => 'নাম্বার ওয়ান বাবার কৃতী সন্তান সংবর্ধনা', 'date' => '০৪ জুন ২০২৪, ২৩:০৮', 'image' => asset('images/news/3.jpg'), 'excerpt' => 'মেঘনা গ্রুপ অব ইন্ডাস্ট্রিজের জনপ্রিয় ব্র্যান্ড নাম্বার ওয়ানের সৌজন্যে গতকাল সোমবার (৩ জুন) রাজধানীর এক অভিজাত হোটেলে নাম্বার ওয়ান বাবার কৃতী সন্তান সংবর্ধনা ২০২৪ অনুষ্ঠিত হয়।', 'link' => 'https://www.ajkerpatrika.com/340119'],
            ['year' => "২০২৪", 'title' => '৫০ কৃতী শিক্ষার্থীর পরিবারকে মেঘনা গ্রুপের সংবর্ধনা', 'date' => '০৪ জুন ২০২৪, ১৯:৩৭', 'image' => asset('images/news/3.jpg'), 'excerpt' => 'এ বছর এসএসসি পরীক্ষায় কৃতিত্বের স্বাক্ষর রাখা ৫০ জন শিক্ষার্থীর পরিবারকে সংবর্ধনা দিয়েছে মেঘনা গ্রুপ অব ইন্ডাস্ট্রিজ।', 'link' => 'https://www.banglatribune.com/press-release/849865'],
            ['year' => "২০২৪", 'title' => 'নাম্বার ওয়ান বাবার কৃতী সন্তান সংবর্ধনা', 'date' => '০৪ জুন ২০২৪ | ২০:০০', 'image' => asset('images/gallery/2024/5.JPG'), 'excerpt' => 'মেঘনা গ্রুপ অব ইন্ডাস্ট্রিজের জনপ্রিয় ব্র্যান্ড নাম্বার ওয়ানের সৌজন্যে গতকাল সোমবার (৩ জুন) রাজধানীর এক অভিজাত হোটেলে নাম্বার ওয়ান বাবার কৃতী সন্তান সংবর্ধনা ২০২৪ অনুষ্ঠিত হয়। ', 'link' => 'https://www.ntvbd.com/economy/news-1411205'],
        ];

        usort($photos, fn($a, $b) => $b['year'] <=> $a['year']);
        usort($videos, fn($a, $b) => $b['year'] <=> $a['year']);
        usort($newsList, fn($a, $b) => $b['year'] <=> $a['year']);


        $availableYears = collect($photos)
            ->merge($videos)
            ->merge($newsList)
            ->pluck('year')
            ->unique()
            ->sortDesc()
            ->values();


        return view('frontend.pages.previous-year.index', compact('photos', 'videos', 'newsList', 'availableYears'));
    }
}
