<?php

// 这三个会依次执行
// 阻塞等待

// 执行闭包函数
(function () {
    // 阻塞2s
    sleep(2);
    echo "1:" . PHP_EOL;
})();
(function () {
    sleep(1);
    echo "2:" . PHP_EOL;
})();
(function () {
    sleep(1);
    echo "3:" . PHP_EOL;
})();