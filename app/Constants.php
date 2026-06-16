<?php
// app/Constants.php

namespace App;

class Constants
{
    // SSC Boards
    const SSC_BOARDS = [
        1 => ['name' => 'Dhaka', 'name_bn' => 'ঢাকা', 'code' => 'DHA'],
        2 => ['name' => 'Rajshahi', 'name_bn' => 'রাজশাহী', 'code' => 'RAJ'],
        3 => ['name' => 'Comilla', 'name_bn' => 'কুমিল্লা', 'code' => 'COM'],
        4 => ['name' => 'Jessore', 'name_bn' => 'যশোর', 'code' => 'JES'],
        5 => ['name' => 'Chittagong', 'name_bn' => 'চট্টগ্রাম', 'code' => 'CHI'],
        6 => ['name' => 'Barisal', 'name_bn' => 'বরিশাল', 'code' => 'BAR'],
        7 => ['name' => 'Sylhet', 'name_bn' => 'সিলেট', 'code' => 'SYL'],
        8 => ['name' => 'Dinajpur', 'name_bn' => 'দিনাজপুর', 'code' => 'DIN'],
        9 => ['name' => 'Madrasah', 'name_bn' => 'মাদ্রাসা', 'code' => 'MAD'],
        10 => ['name' => 'Technical', 'name_bn' => 'টেকনিক্যাল', 'code' => 'TEC'],
    ];

    // Student Groups
    const STUDENT_GROUPS = [
        1 => ['name' => 'Science', 'name_bn' => 'বিজ্ঞান', 'code' => 'SCI'],
        2 => ['name' => 'Arts', 'name_bn' => 'মানবিক', 'code' => 'ART'],
        3 => ['name' => 'Commerce', 'name_bn' => 'বাণিজ্য', 'code' => 'COM'],
    ];

    // User Types
    const USER_TYPES = [
        1 => ['name' => 'Student', 'slug' => 'student'],
        2 => ['name' => 'Admin', 'slug' => 'admin'],
        3 => ['name' => 'No.1 Brand Team', 'slug' => 'brand-team'],
        4 => ['name' => 'Sales Team', 'slug' => 'sales-team'],
        5 => ['name' => 'Agency Team', 'slug' => 'agency-team'],
        6 => ['name' => 'Scholarship Partners', 'slug' => 'scholarship-partners'],
        7 => ['name' => 'Event Management Team', 'slug' => 'event-team'],
    ];
}