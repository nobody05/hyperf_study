<?php

declare(strict_types=1);

namespace App\Controller;


use Hyperf\Contract\OnCloseInterface;
use Hyperf\Contract\OnMessageInterface;
use Hyperf\Contract\OnOpenInterface;
use Swoole\Http\Request;
use Swoole\WebSocket\Frame;

class WebSocketController implements OnMessageInterface, OnOpenInterface, OnCloseInterface
{
    public function onOpen($server, Request $request): void
    {
        echo "ws onopen". PHP_EOL;
        // TODO: Implement onOpen() method.
    }

    public function onMessage($server, Frame $frame): void
    {
        echo 'get-msg '. $frame->data;
        // TODO: Implement onMessage() method.

        $server->push($frame->fd, 'hello-client'. $frame->fd);
    }

    public function onClose($server, int $fd, int $reactorId): void
    {
        // TODO: Implement onClose() method.
    }

}