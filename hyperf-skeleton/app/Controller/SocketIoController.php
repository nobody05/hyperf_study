<?php

declare(strict_types=1);

namespace App\Controller;


use Hyperf\SocketIOServer\Annotation\Event;
use Hyperf\SocketIOServer\Annotation\SocketIONamespace;
use Hyperf\SocketIOServer\BaseNamespace;
use Hyperf\SocketIOServer\Socket;
use Hyperf\Utils\Codec\Json;

/**
 * Class SocketIoController
 * @package App\Controller
 *
 * @SocketIONamespace("/")
 */
class SocketIoController extends BaseNamespace
{

    /**
     *
     * @Event("event")
     *
     * @param Socket $socket
     * @param $data
     *
     */
    public function onEvent(Socket $socket, $data)
    {
        echo 'Event get data'. $data;

    }

    /**
     *
     * @Event("join-room")
     *
     *
     * @param Socket $socket
     * @param $data
     */
    public function onJoinRoom(Socket $socket, $data)
    {
        $socket->join($data);

        $msg = $socket->getSid(). " has join room: ". $data;
        $socket->to($data)->emit("new-user-join", $msg);
    }

    /**
     * @Event("new-msg")
     *
     * @param Socket $socket
     * @param $data
     */
    public function onNewMsg(Socket $socket, $data)
    {
        $msg = Json::decode($data);

        print_r($socket->getSid(). 'msg');

        $content = $socket->getSid(). ' say: '. $msg['message'];
        // 群发&自己
        $socket->to($msg['room'])->emit('new-msg', $content);
        $socket->emit("new-msg", $content);
    }

    /**
     * @param Socket $socket
     * @param $data
     *
     * @Event("leave-room")
     */
    public function onLeaveRoom(Socket $socket, $data)
    {
        $socket->to($data)->emit('user-leave', $socket->getSid(). " has leave room: ". $data);

        $socket->leave($data);

    }




}