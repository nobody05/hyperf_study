<?php

use Swoole\Coroutine;

// 创建通道   配置容量1，每次只能有一条消息，消费完才能push,
// 当通道满了之后，生产者协程就要阻塞等待了
$channel = new Swoole\Coroutine\Channel(1);
Swoole\Coroutine::create(function()use($channel){
    for ($i=0; $i<3; $i++) {
        // 往通道中push数据
        $channel->push($i);
    }
});


Swoole\Coroutine::create(function()use($channel){
    for ($i=0; $i<3; $i++) {
        echo "current-chan-status";
        print_r($channel->stats());

        Coroutine::sleep(1);
        // 从通道获取数据
        $data = $channel->pop();
        echo "get-from-chan: ". $data. PHP_EOL;
    }
});
