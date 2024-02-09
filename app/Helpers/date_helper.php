<?php

if (!function_exists('translate_date')) {
    function translate_date($formattedDate)
    {
        $translations = [
            'Monday'    => 'Senin',
            'Tuesday'   => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday'  => 'Kamis',
            'Friday'    => 'Jumat',
            'Saturday'  => 'Sabtu',
            'Sunday'    => 'Minggu',
            'January'    => 'Januari',
            'February'    => 'Februari',
            'March'    => 'Maret',
            'May'    => 'Mei',
            'June'    => 'Juni',
            'July'    => 'Juli',
            'August'    => 'Agustus',
            'October'    => 'Oktober',
            'December'    => 'Desember'
        ];

        // Replace English names with Bahasa Indonesia
        return str_replace(array_keys($translations), array_values($translations), $formattedDate);
    }
}
