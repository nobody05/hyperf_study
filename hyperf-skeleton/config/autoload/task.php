<?php

declare(strict_types=1);

use Hyperf\Server\SwooleEvent;

return [
    // 这里省略了其它不相关的配置项
    'settings' => [
        // Task Worker 数量，根据您的服务器配置而配置适当的数量
        'task_worker_num' => 4,
        // 因为 `Task` 主要处理无法协程化的方法，所以这里推荐设为 `false`，避免协程下出现数据混淆的情况
        'task_enable_coroutine' => false,
    ],
    'callbacks' => [
        // Task callbacks
        SwooleEvent::ON_TASK => [Hyperf\Framework\Bootstrap\TaskCallback::class, 'onTask'],
        SwooleEvent::ON_FINISH => [Hyperf\Framework\Bootstrap\FinishCallback::class, 'onFinish'],
    ],
];