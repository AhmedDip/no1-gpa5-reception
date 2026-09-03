<?php

namespace App\Helpers;

class BanglaPdfHelper
{
    /**
     * Fix Bangla text rendering for DomPDF
     * This reorders vowel signs and handles conjunct characters
     */
    public static function fixBanglaLayout($text)
    {
        if (empty($text)) {
            return $text;
        }

        // Step 1: Fix vowel signs (কার) positioning
        // ি (U+09BF) should come before the consonant
        // ে (U+09C7) should come before the consonant
        // ো (U+09CB) is a combination of ে + া

        $patterns = [
            // Fix ি (kar) - moves after consonant to before consonant
            '/([\x{09B0}-\x{09B9}])\x{09BF}/u' => '\x{09BF}$1',

            // Fix ে (e-kar) - moves after consonant to before consonant
            '/([\x{09B0}-\x{09B9}])\x{09C7}/u' => '\x{09C7}$1',

            // Fix ো (o-kar) - complex combination
            '/([\x{09B0}-\x{09B9}])\x{09CB}/u' => '\x{09CB}$1',

            // Fix ৈ (oi-kar)
            '/([\x{09B0}-\x{09B9}])\x{09C8}/u' => '\x{09C8}$1',

            // Fix ৌ (ou-kar)
            '/([\x{09B0}-\x{09B9}])\x{09CC}/u' => '\x{09CC}$1',
        ];

        $text = preg_replace(array_keys($patterns), array_values($patterns), $text);

        // Step 2: Handle common conjunct characters (যুক্তাক্ষর)
        // This is a basic mapping - you may need to add more
        $conjuncts = [
            'ক্ত' => 'ক‍্ত',
            'ক্ট' => 'ক‍্ট',
            'ক্স' => 'ক‍্স',
            'ক্ষ' => 'ক‍্ষ',
            'ঙ্গ' => 'ঙ‍্গ',
            'ঞ্চ' => 'ঞ‍্চ',
            'ঞ্জ' => 'ঞ‍্জ',
            'ঞ্ছ' => 'ঞ‍্ছ',
            'ঞ্জ' => 'ঞ‍্জ',
            'ঞ্ঝ' => 'ঞ‍্ঝ',
            'ট্ট' => 'ট‍্ট',
            'ট্ঠ' => 'ট‍্ঠ',
            'ড্ড' => 'ড‍্ড',
            'ণ্ট' => 'ণ‍্ট',
            'ণ্ঠ' => 'ণ‍্ঠ',
            'ণ্ড' => 'ণ‍্ড',
            'ণ্ণ' => 'ণ‍্ণ',
            'ত্ত' => 'ত‍্ত',
            'ত্থ' => 'ত‍্থ',
            'ত্র' => 'ত‍্র',
            'ত্ব' => 'ত‍্ব',
            'দ্দ' => 'দ‍্দ',
            'দ্ধ' => 'দ‍্ধ',
            'দ্ব' => 'দ‍্ব',
            'দ্র' => 'দ‍্র',
            'ধ্র' => 'ধ‍্র',
            'ন্ন' => 'ন‍্ন',
            'ন্স' => 'ন‍্স',
            'ন্ত' => 'ন‍্ত',
            'ন্ত্র' => 'ন‍্ত্র',
            'ন্থ' => 'ন‍্থ',
            'ন্দ' => 'ন‍্দ',
            'ন্ধ' => 'ন‍্ধ',
            'ন্ন' => 'ন‍্ন',
            'ন্স' => 'ন‍্স',
            'প্ত' => 'প‍্ত',
            'প্ত্র' => 'প‍্ত্র',
            'প্স' => 'প‍্স',
            'প্ত' => 'প‍্ত',
            'প্র' => 'প‍্র',
            'প্ল' => 'প‍্ল',
            'ফ্র' => 'ফ‍্র',
            'ফ্ল' => 'ফ‍্ল',
            'ব্দ' => 'ব‍্দ',
            'ব্ধ' => 'ব‍্ধ',
            'ব্ব' => 'ব‍্ব',
            'ব্র' => 'ব‍্র',
            'ভ্র' => 'ভ‍্র',
            'ম্ন' => 'ম‍্ন',
            'ম্প' => 'ম‍্প',
            'ম্প্র' => 'ম‍্প্র',
            'ম্ব' => 'ম‍্ব',
            'ম্ভ' => 'ম‍্ভ',
            'ম্ম' => 'ম‍্ম',
            'ম্য' => 'ম‍্য',
            '্য' => '্য',
            '্র' => '্র',
            'র্ত্ত' => 'র্ত্ত',
            'র্দ্দ' => 'র্দ্দ',
            'র্স' => 'র্স',
            'ল্ক' => 'ল‍্ক',
            'ল্গ' => 'ল‍্গ',
            'ল্প' => 'ল‍্প',
            'ল্ফ' => 'ল‍্ফ',
            'ল্ব' => 'ল‍্ব',
            'ল্ম' => 'ল‍্ম',
            'ল্ল' => 'ল‍্ল',
            'শ্চ' => 'শ‍্চ',
            'শ্ছ' => 'শ‍্ছ',
            'শ্ন' => 'শ‍্ন',
            'শ্প' => 'শ‍্প',
            'শ্ব' => 'শ‍্ব',
            'শ্ম' => 'শ‍্ম',
            'শ্র' => 'শ‍্র',
            'ষ্ক' => 'ষ‍্ক',
            'ষ্ট' => 'ষ‍্ট',
            'ষ্ঠ' => 'ষ‍্ঠ',
            'ষ্প' => 'ষ‍্প',
            'ষ্ফ' => 'ষ‍্ফ',
            'ষ্ম' => 'ষ‍্ম',
            'স্ক' => 'স‍্ক',
            'স্ট' => 'স‍্ট',
            'স্ত' => 'স‍্ত',
            'স্ত্র' => 'স‍্ত্র',
            'স্থ' => 'স‍্থ',
            'স্ন' => 'স‍্ন',
            'স্প' => 'স‍্প',
            'স্প্র' => 'স‍্প্র',
            'স্ব' => 'স‍্ব',
            'স্ম' => 'স‍্ম',
            'স্য' => 'স‍্য',
            'হ্ণ' => 'হ‍্ণ',
            'হ্ন' => 'হ‍্ন',
            'হ্ম' => 'হ‍্ম',
            'হ্র' => 'হ‍্র',
            'হ্ল' => 'হ‍্ল',
        ];

        foreach ($conjuncts as $wrong => $correct) {
            $text = str_replace($wrong, $correct, $text);
        }

        return $text;
    }

    /**
     * Alternative: Convert to HTML entities for better rendering
     */
    public static function toHtmlEntities($text)
    {
        return mb_convert_encoding($text, 'HTML-ENTITIES', 'UTF-8');
    }

    /**
     * Combined fix - applies both layout fixes and entity conversion
     */
    public static function prepareForPdf($text)
    {
        $fixed = self::fixBanglaLayout($text);
        return self::toHtmlEntities($fixed);
    }
}
