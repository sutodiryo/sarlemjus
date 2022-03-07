<?php
date_default_timezone_set("Asia/Jakarta");

function date_time_id($datetime)
{
    return "" . $datetime->format('d M Y') . " <small>Pukul " . $datetime->format('H:i') . "</small>";
}

function today()
{
    $hari = date("D");

    switch ($hari) {
        case 'Sun':
            $hari_ini = "Minggu";
            break;

        case 'Mon':
            $hari_ini = "Senin";
            break;

        case 'Tue':
            $hari_ini = "Selasa";
            break;

        case 'Wed':
            $hari_ini = "Rabu";
            break;

        case 'Thu':
            $hari_ini = "Kamis";
            break;

        case 'Fri':
            $hari_ini = "Jumat";
            break;

        case 'Sat':
            $hari_ini = "Sabtu";
            break;

        default:
            $hari_ini = "Tidak di ketahui";
            break;
    }
    return $hari_ini;
}

function date_now()
{
    date_default_timezone_set('Asia/Jakarta');
    $date = mktime(date("m"), date("d"), date("Y"));
    $now = date("Y-m-d", $date);

    $month = array(
        1 => 'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );
    $x = explode('-', $now);

    return $x[2] . ' ' . $month[(int) $x[1]] . ' ' . $x[0];
}

// Format tanggal Indonesia by STRING
function date_id($date)
{
    $d = explode(' ', $date);
    $new_date = $d[0];
    date_default_timezone_set('Asia/Jakarta');
    $month = array(
        1 => 'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );
    $x = explode('-', $new_date);
    return $x[2] . ' ' . $month[(int) $x[1]] . ' ' . $x[0];
}

function get_time($timestamp)
{
    $splitTimeStamp = explode(" ", $timestamp);
    $time = $splitTimeStamp[1];
    return $time;
}

function get_date($bln)
{
    switch ($bln) {
        case 1:
            return "Januari";
            break;
        case 2:
            return "Februari";
            break;
        case 3:
            return "Maret";
            break;
        case 4:
            return "April";
            break;
        case 5:
            return "Mei";
            break;
        case 6:
            return "Juni";
            break;
        case 7:
            return "Juli";
            break;
        case 8:
            return "Agustus";
            break;
        case 9:
            return "September";
            break;
        case 10:
            return "Oktober";
            break;
        case 11:
            return "November";
            break;
        case 12:
            return "Desember";
            break;
    }
    return $bln;
}
