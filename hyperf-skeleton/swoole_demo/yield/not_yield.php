<?php

$start = 1;
$end = 1000000;

echo 'type1-use:'. (memory_get_peak_usage(true) / 1024 / 1024). 'M'. PHP_EOL;

foreach (range($start, $end) as $value) {
    if ($value < 10) {
        echo $value . PHP_EOL;
    }

}

echo 'type1-end:'. (memory_get_peak_usage(true) / 1024 / 1024). 'M'. PHP_EOL;

echo "----------------". PHP_EOL;

