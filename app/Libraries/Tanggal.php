<?php

namespace App\Libraries;

class Tanggal
{
    function tanggalkini()
    {
        $y = date("Y");
        $d = date("d");
        $D = date("D");
        $m = date("m");

        switch ($m) {
            case "01":
                $b = "Januari";
                break;
            case "02":
                $b = "Februari";
                break;
            case "03":
                $b = "Maret";
                break;
            case "04":
                $b = "April";
                break;
            case "05":
                $b = "Mei";
                break;
            case "06":
                $b = "Juni";
                break;
            case "07":
                $b = "Juli";
                break;
            case "08":
                $b = "Agustus";
                break;
            case "09":
                $b = "September";
                break;
            case "10":
                $b = "Oktober";
                break;
            case "11":
                $b = "November";
                break;
            default:
                $b = "Desember";
        }

        switch ($D) {
            case "Mon":
                $h = "Senin";
                break;
            case "Tue":
                $h = "Selasa";
                break;
            case "Wed":
                $h = "Rabu";
                break;
            case "Thu":
                $h = "Kamis";
                break;
            case "Fri":
                $h = "Jum'at";
                break;
            case "Sat":
                $h = "Sabtu";
                break;
            default:
                $h = "Minggu";
        }

        return $h . ", " . $d . " " . $b . " " . $y;
    }

    function tanggalkinis()
    {
        $y = date("Y");
        $d = date("d");
        $m = date("m");

        switch ($m) {
            case "01":
                $b = "Januari";
                break;
            case "02":
                $b = "Februari";
                break;
            case "03":
                $b = "Maret";
                break;
            case "04":
                $b = "April";
                break;
            case "05":
                $b = "Mei";
                break;
            case "06":
                $b = "Juni";
                break;
            case "07":
                $b = "Juli";
                break;
            case "08":
                $b = "Agustus";
                break;
            case "09":
                $b = "September";
                break;
            case "10":
                $b = "Oktober";
                break;
            case "11":
                $b = "November";
                break;
            default:
                $b = "Desember";
        }

        return $d . " " . $b . " " . $y;
    }

    function pilbulan($bulan)
    {
        switch ($bulan) {
            case "01":
                $b = "Januari";
                break;
            case "02":
                $b = "Februari";
                break;
            case "03":
                $b = "Maret";
                break;
            case "04":
                $b = "April";
                break;
            case "05":
                $b = "Mei";
                break;
            case "06":
                $b = "Juni";
                break;
            case "07":
                $b = "Juli";
                break;
            case "08":
                $b = "Agustus";
                break;
            case "09":
                $b = "September";
                break;
            case "10":
                $b = "Oktober";
                break;
            case "11":
                $b = "November";
                break;
            default:
                $b = "Desember";
        }

        return $b;
    }

    function contanggal($dc, $mc, $yc)
    {
        $datec = strtotime($mc . "/" . $dc . "/" . $yc);
        $hd = date("D", $datec);
        switch ($hd) {
            case "Mon":
                $hc = "Senin";
                break;
            case "Tue":
                $hc = "Selasa";
                break;
            case "Wed":
                $hc = "Rabu";
                break;
            case "Thu":
                $hc = "Kamis";
                break;
            case "Fri":
                $hc = "Jum'at";
                break;
            case "Sat":
                $hc = "Sabtu";
                break;
            default:
                $hc = "Minggu";
        }
        switch ($mc) {
            case "01":
                $bc = "Januari";
                break;
            case "02":
                $bc = "Februari";
                break;
            case "03":
                $bc = "Maret";
                break;
            case "04":
                $bc = "April";
                break;
            case "05":
                $bc = "Mei";
                break;
            case "06":
                $bc = "Juni";
                break;
            case "07":
                $bc = "Juli";
                break;
            case "08":
                $bc = "Agustus";
                break;
            case "09":
                $bc = "September";
                break;
            case "10":
                $bc = "Oktober";
                break;
            case "11":
                $bc = "November";
                break;
            default:
                $bc = "Desember";
        }

        return $hc . ", " . $dc . " " . $bc . " " . $yc;
    }

    function contanggalx($dc, $mc, $yc)
    {
        switch ($mc) {
            case "01":
                $bc = "Januari";
                break;
            case "02":
                $bc = "Februari";
                break;
            case "03":
                $bc = "Maret";
                break;
            case "04":
                $bc = "April";
                break;
            case "05":
                $bc = "Mei";
                break;
            case "06":
                $bc = "Juni";
                break;
            case "07":
                $bc = "Juli";
                break;
            case "08":
                $bc = "Agustus";
                break;
            case "09":
                $bc = "September";
                break;
            case "10":
                $bc = "Oktober";
                break;
            case "11":
                $bc = "November";
                break;
            default:
                $bc = "Desember";
        }

        return $dc . " " . $bc . " " . $yc;
    }

    function time_since($original)
    {
        date_default_timezone_set('Asia/Jakarta');
        $chunks = array(
            array(60 * 60 * 24 * 365, 'tahun'),
            array(60 * 60 * 24 * 30, 'bulan'),
            array(60 * 60 * 24 * 7, 'minggu'),
            array(60 * 60 * 24, 'hari'),
            array(60 * 60, 'jam'),
            array(60, 'menit'),
        );

        $today = time();
        $since = $today - $original;

        for ($i = 0, $j = count($chunks); $i < $j; $i++) {
            $seconds = $chunks[$i][0];
            $name = $chunks[$i][1];

            if (($count = floor($since / $seconds)) != 0)
                break;
        }

        $print = ($count == 1) ? '1 ' . $name : "$count {$name}";
        return $print . ' yang lalu';
    }
    function umur($tgllahir)
    {
        list($tahun, $bulan, $tanggal) = explode("-", $tgllahir);
        $th = date("Y") - $tahun;
        $bln = date("m") - $bulan;
        $hr = date("d") - $tanggal;


        if ($bln < 0)
            $th--;
        elseif (($bln == 0) and ($hr < 0))
            $th--;


        return $th . " Tahun";
    }
    function time_diff($date_str, $date_end)
    {
        date_default_timezone_set('Asia/Jakarta');
        $chunks = array(
            array(60 * 60 * 24 * 365, 'tahun'),
            array(60 * 60 * 24 * 30, 'bulan'),
            array(60 * 60 * 24 * 7, 'minggu'),
            array(60 * 60 * 24, 'hari'),
            array(60 * 60, 'jam'),
            array(60, 'menit'),
        );

        $diff = $date_end - $date_str;

        for ($i = 0, $j = count($chunks); $i < $j; $i++) {
            $seconds = $chunks[$i][0];
            $name = $chunks[$i][1];

            if (($count = floor($diff / $seconds)) != 0)
                break;
        }
        return ($count < 1) ? "Expired" : "$count $name";
    }
    function time_diff_day($date_str, $date_end)
    {
        $daydiff = $date_end - $date_str;
        return ($daydiff / (60 * 60 * 24));
    }
}
