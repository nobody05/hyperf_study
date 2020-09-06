<?php

//阻塞模式  一个一个的执行

$start =  microtime_float();
print_r(selectDB([10000,10001,10002]));
echo "finished---3". PHP_EOL;
print_r(selectDB([10003,10004,10005]));
echo "finished---5". PHP_EOL;

echo PHP_EOL;

echo '---1---';

$end =  microtime_float();
echo "use-time: ". ($end-$start);

function selectDB($ids)
{
    $mysqlconn = new mysqli('127.0.0.1', 'root', 'root', 'test');
    $result = $mysqlconn->query("
    select id, name from heros where id in (".implode(',', $ids).")
");

    $arr = [];
    foreach ($result->fetch_all(MYSQLI_ASSOC) as $k=>$info) {
        $arr[] = $info;
    }

    return $arr;

}

function microtime_float()
{
    list($usec, $sec) = explode(" ", microtime());
    return ((float)$usec + (float)$sec);
}