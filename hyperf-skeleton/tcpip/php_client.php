<?php
// 连接到server
$client = stream_socket_client("tcp://127.0.0.1:8091", $errno, $errstr);
if ($errno) {
    throw new Exception("client create err: ". $errstr);
}

echo "client connect success". PHP_EOL;


$minId = $argv[1];
$maxId = $argv[2];

$sleep = $argv[3];

echo "sleep: ". $sleep. PHP_EOL;

// 通过sleep产生阻塞，占用server连接
sleep($sleep);

// 写入数据
fwrite($client, "hello server,{$minId}-{$maxId}");
// 读取数据
while ($content = fread($client, 100)) {
    echo "get content from server :". $content. PHP_EOL;

}
