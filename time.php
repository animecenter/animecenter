<?php

// date_default_timezone_set('America/Edmonton');
function time_elapsed_string($ptime) {
    $time = time();
    echo 'Now: ' . $time;
    echo '<br/>';
    echo 'Time: ' . $ptime;
    echo '<br/>';
    $etime = $time - $ptime;
    echo 'Diff: ' . $etime;

    if ($etime < 1) {
        return '0 seconds';
    }

    $a = array(
        12 * 30 * 24 * 60 * 60 => 'year',
        30 * 24 * 60 * 60 => 'month',
        24 * 60 * 60 => 'day',
        60 * 60 => 'hour',
        60 => 'minute',
        1 => 'second'
    );

    foreach ($a as $secs => $str) {
        $d = $etime / $secs;
        if ($d >= 1) {
            $r = round($d);
            return $r . ' ' . $str . ($r > 1 ? 's' : '') . ' ago';
        }
    }
}

echo '<br/>';
echo time_elapsed_string('1428376419');
