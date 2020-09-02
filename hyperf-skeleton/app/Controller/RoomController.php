<?php
declare(strict_types=1);

namespace App\Controller;


use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\GetMapping;
use Hyperf\View\RenderInterface;

/**
 * @Controller("/room")
 * Class RoomController
 * @package App\Controller
 */
class RoomController extends AbstractController
{
    /**
     * @param RenderInterface $render
     * @return \Psr\Http\Message\ResponseInterface
     *
     * @GetMapping("index")
     */
    public function index(RenderInterface $render)
    {
        return $render->render('socketio/index', ['title' => 'socketio']);
    }

    /**
     * @GetMapping("login")
     */
    public function login()
    {




    }
}