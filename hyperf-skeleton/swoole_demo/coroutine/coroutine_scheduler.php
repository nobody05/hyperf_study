<?php

// 创建调度器
$scheduler = new Swoole\Coroutine\Scheduler();

// 添加一个协程任务
$scheduler->add(function($num){
    echo "start-one". PHP_EOL;
    \Swoole\Coroutine::sleep(1);

    echo $num. PHP_EOL;

}, 11);

// 添加第二个协程任务
$scheduler->add(function($num){
    echo "start-two". PHP_EOL;

    echo $num. PHP_EOL;
}, 12);


// 启动调度器开始执行
$scheduler->start();