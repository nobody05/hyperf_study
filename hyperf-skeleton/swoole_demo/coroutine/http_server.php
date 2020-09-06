<?php

$server = new Swoole\Http\Server('127.0.0.1', 9505);
$server->set([
   'worker_num' => 1,
]);
$server->on('request', function(\Swoole\Http\Request $request, \Swoole\Http\Response $response){

    // swoole实现的当前请求协程的上下文，上下文可以理解为跟随这个协程生命周期的一些状态、属性、环境等等
    $currentContext = \Swoole\Coroutine::getContext();
    $currentContext['request-time'] = time();


    $response->header("Content-type", "application/json");
    $response->end(json_encode([
        'name' => 'hello',
        'time' => $currentContext['request-time']
    ]));
});



$server->on('workerStart', function(Swoole\Server $server, $workerId){
    echo "workerStart workerId: ". $workerId. PHP_EOL;
});




$server->start();

