<?php
ini_set("memory_limit", -1);

// 创建一个tcp server
$server = stream_socket_server("tcp://127.0.0.1:8092", $errno, $errstr);
if ($errno) {
    throw new Exception("server create err". $errstr);
}

echo "server start ". PHP_EOL;

// 等待请求
while ($clientConn = stream_socket_accept($server, -1)) {

    $streamId = (string) $clientConn;
    echo "get-new-client-connect: ". $streamId. PHP_EOL;

    // 接收数据
    $data = stream_socket_recvfrom($clientConn, 100);

    echo "receive data :". $data. PHP_EOL;

    $datas = explode(',', $data);
    [$minId,$maxId] = explode('-', $datas[1]);

    $start = microtime_float();
    // 通过查询DB产生IO
    $count = selectDB($minId, $maxId);
    $end = microtime_float();
    $times = $end-$start;

    // 发送数据
    stream_socket_sendto($clientConn, "你好客户端: ". $streamId . ' : ' . date("Y-m-d H:i:s") . '  minid: '. $minId. ' maxid: '. $maxId .  ' dbCount: '. $times);

    fclose($clientConn);

}

fclose($server);


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





