<?php

\Swoole\Runtime::enableCoroutine(true);

// 协程话之后，swoole自动调度协程的执行

$start =  microtime_float();
// 创建一个协程 执行这个查询
\Swoole\Coroutine::create(function(){
    $result = selectDB([10000,10001,10002]);


});

//print_r($result);




echo PHP_EOL;

echo '---1---';

$end = microtime_float();

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