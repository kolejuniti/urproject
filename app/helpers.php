<?php

if (!function_exists('determineSourceFromReferrer')) {
    function determineSourceFromReferrer($referrer)
    {
        $referrer = strtolower($referrer); // case insensitive

        if ($referrer === 'other') {
            return 'e-Daftar';
        } elseif ($referrer === 'tiktok') {
            return 'tiktok';
        }

        if (strpos($referrer, 'facebook.com') !== false) {
            return 'facebook';
        } elseif (strpos($referrer, 'whatsapp.com') !== false) {
            return 'whatsapp';
        } elseif (strpos($referrer, 'tiktok.com') !== false || strpos($referrer, 'pangleglobal.com') !== false || strpos($referrer, 'pangle.io') !== false) {
            return 'tiktok';
        } elseif (strpos($referrer, 'instagram.com') !== false) {
            return 'instagram';
        } elseif (strpos($referrer, 'edaftarkolej.uniticms.edu.my') !== false) {
            return 'e-Daftar';
        } elseif (strpos($referrer, 'uniti.edu.my') !== false) {
            return 'website';
        } elseif (strpos($referrer, 'google.com') !== false || strpos($referrer, 'google.com.my') !== false) {
            return 'google';
        } elseif (strpos($referrer, 'youtube.com') !== false) {
            return 'youtube';
        }

        return 'e-Daftar'; // default fallback
    }
}
