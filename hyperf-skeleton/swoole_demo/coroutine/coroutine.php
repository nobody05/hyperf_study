<?php


use Swoole\Coroutine;
use Swoole\Runtime;

// 这里创建三个协程，分别去执行
// 当sleep产生阻塞时，当前协程就会挂起，执行下一个

// 开启协程支持  sleep函数如果不开启是不会产生
// IO阻塞的情况
Swoole\Runtime::enableCoroutine();

// 创建一个协程
Swoole\Coroutine::create(function () {
    // 模拟I/O阻塞了
    sleep(2);
    echo 1 . ':' . PHP_EOL;
});
Swoole\Coroutine::create(function () {
    sleep(1);
    echo 2 . ':' . PHP_EOL;
});
Swoole\Coroutine::create(function () {
    sleep(1);
    echo 3 . ':' . PHP_EOL;
});