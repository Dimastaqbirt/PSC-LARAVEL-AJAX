<?php

use Carbon\Carbon;

if (!function_exists('calculateDistance')) {
    function calculateDistance($latPresesensi, $lonPresesensi, $latSetting, $lonSetting)
    {
        if (!is_numeric($latPresesensi) || !is_numeric($lonPresesensi) || !is_numeric($latSetting) || !is_numeric($lonSetting)) {
            throw new InvalidArgumentException('Invalid input. Latitude and longitude should be numeric.');
        }

        if ($latPresesensi < -90 || $latPresesensi > 90 || $latSetting < -90 || $latSetting > 90 || $lonPresesensi < -180 || $lonPresesensi > 180 || $lonSetting < -180 || $lonSetting > 180) {
            throw new InvalidArgumentException('Invalid input. Latitude should be between -90 and 90, and longitude should be between -180 and 180.');
        }

        $latPresesensiRad = deg2rad($latPresesensi);
        $lonPresesensiRad = deg2rad($lonPresesensi);
        $latSettingRad = deg2rad($latSetting);
        $lonSettingRad = deg2rad($lonSetting);

        $deltaLat = $latSettingRad - $latPresesensiRad;
        $deltaLon = $lonSettingRad - $lonPresesensiRad;
        $a = sin($deltaLat / 2) * sin($deltaLat / 2) + cos($latPresesensiRad) * cos($latSettingRad) * sin($deltaLon / 2) * sin($deltaLon / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        $distance = 6371 * $c;

        return $distance * 1000;
    }
}

if (!function_exists('calculateSelisihJarak')) {
    function calculateSelisihJarak($selisih)
    {
        return ($selisih < 1000) ? $selisih . ' meter' : round($selisih / 1000, 2) . ' km';
    }
}

if (!function_exists('statusBadge')) {
    function statusBadge($status)
    {
        $statusIcon = ($status == '0') ? '<i class="far fa-clock mr-1"></i>' : (($status == '1') ? '<i class="far fa-check-circle mr-1"></i>' : '<i class="far fa-times-circle mr-1"></i>');
        $statusClass = ($status == '0') ? 'badge-warning' : (($status == '1') ? 'badge-success' : 'badge-danger');
        $statusText = ($status == '0') ? 'Menunggu' : (($status == '1') ? 'Disetujui' : 'Ditolak');

        return "<span class='badge $statusClass'>$statusIcon $statusText</span>";
    }
}

if (!function_exists('jenisBadge')) {
    function jenisBadge($jenis)
    {
        $jenisIcon = ($jenis == 'Masuk') ? '<i class="fas fa-plus-square mr-1"></i>' : '<i class="fas fa-minus-square mr-1"></i>';
        $jenisClass = ($jenis == 'Masuk') ? 'badge-success' :  'badge-danger';

        return "<span class='badge $jenisClass'>$jenisIcon $jenis</span>";
    }
}

if (!function_exists('generateBase64Image')) {
    function generateBase64Image($imagePath)
    {
        if (file_exists($imagePath)) {
            $data = file_get_contents($imagePath);
            $type = pathinfo($imagePath, PATHINFO_EXTENSION);
            $base64Image = 'data:image/' . $type . ';base64,' . base64_encode($data);

            return $base64Image;
        } else {
            return '';
        }
    }
}

if (!function_exists('formatTanggal')) {
    function formatTanggal($tanggal = null, $format = 'l, j F Y')
    {
        $parsedDate = Carbon::parse($tanggal)->locale('id')->settings(['formatFunction' => 'translatedFormat']);
        return $parsedDate->format($format);
    }
}

if (!function_exists('getGreeting')) {
    function getGreeting()
    {
        $hour = now()->hour;

        if ($hour >= 5 && $hour < 12) {
            return 'Selamat Pagi';
        } elseif ($hour >= 12 && $hour < 17) {
            return 'Selamat Siang';
        } elseif ($hour >= 17 && $hour < 20) {
            return 'Selamat Sore';
        } else {
            return 'Selamat Malam';
        }
    }
}
