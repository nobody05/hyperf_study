<?php
ini_set("memory_limit", -1);

// 创建一个tcp server
$server = stream_socket_server("tcp://127.0.0.1:8091", $errno, $errstr);
// 设置非阻塞模式
stream_set_blocking($server, 0);

if ($errno) {
    throw new Exception("server create err" . $errstr);
}
echo "server start ". PHP_EOL;

$wirtes = $exceps = [];
$clients[] = $server;

while (true) {
    $reads = $clients;
    // 调用select去轮询read事件
    if (@stream_select($reads, $wirtes, $exceps, 100000) > 0) {

        // 如果是主socket也就是server有可读事件，也就是客户端连接
        if (in_array($server, $reads)) {
            $clients[] = stream_socket_accept($server, 1000, $peername);
            $serverK = array_search($server, $reads);
            unset($reads[$serverK]);
        }
        if (count($reads) <= 0) continue;

        // 剩下的都是client的消息
        foreach ($reads as $ks => $_server) {
            // client
            $data = fread($_server, 100);
            $streamId = (string)$_server;

            echo "get-data-from-client :". $streamId. PHP_EOL;

            $peername = stream_socket_get_name($_server, true);

            echo "receive data :" . $data . PHP_EOL;

            // 解析ID
            $datas = explode(',', $data);
            [$minId, $maxId] = explode('-', $datas[1]);

            $start = microtime_float();
            $count = selectDB($minId, $maxId);
            $end = microtime_float();
            $times = $end - $start;

            echo $streamId. ": ". $peername. "-select-finish". PHP_EOL;

            // 发送数据
            fwrite($_server,
                "你好客户端: " . $streamId . ':' . date("Y-m-d H:i:s") . ' minid: ' . $minId . ' maxid: ' . $maxId . ' dbCount: ' . $times);

            fclose($_server);

        }
    }
}


function selectDB($minId, $maxId)
{
    $mysqlconn = new mysqli('127.0.0.1', 'root', 'root', 'test');
    $result = $mysqlconn->query("
    select * from user where id between ".$minId." and ". $maxId);

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



