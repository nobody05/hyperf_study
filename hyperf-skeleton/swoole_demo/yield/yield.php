<?php

$start = 1;
$end = 1000000;



function selfRange($start, $end)
{
    for ($i=$start, $j=0; $i<=$end; $i++,$j++) {
        yield $j => $i;
    }
}


var_dump(selfRange($start, $end));

echo 'type2-use:'. (memory_get_peak_usage(true) / 1024 / 1024). 'M'. PHP_EOL;
foreach (selfRange($start, $end) as $value) {
    if ($value < 10) {
        echo $value . PHP_EOL;
    }
}
echo 'type2-end:'. (memory_get_peak_usage(true) / 1024 / 1024). 'M'. PHP_EOL;