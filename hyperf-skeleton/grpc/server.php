<?php

require __DIR__."/../vendor/autoload.php";

//$server = new \Swoole\Server("127.0.0.1", 9111);
//
//$server->set([
//
//]);
//
//$server->on("Connect", function(\Swoole\Server $server, $fd){
//
//});
//
//$server->on("Receive", function($server, $fd){
//    echo "receive Message";
//});
//
//$server->start();


$server = new \Grpc\Server();
$server->addHttp2Port("127.0.0.1:9091");

$server->start();


