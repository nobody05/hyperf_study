<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://doc.hyperf.io
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
namespace App\Controller;

use App\Model\User;
use App\Service\UserService;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\GetMapping;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;

/**
 * Class IndexController
 * @package App\Controller
 * @Controller(prefix="api/v1/test")
 */
class IndexController extends AbstractController
{
    /**
     * @var UserService
     */
    protected $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @return array
     * @GetMapping(path="index")
     */
    public function index(RequestInterface $request, ResponseInterface $response)
    {
        $user = $request->input('user', 'Hyperf');
        $method = $request->getMethod();
        $s = $this->userService->getNameById(500);


        return [
            'method' => $method,
            'message' => "Hello {$user}.",
            'name' => $s
        ];
    }
}
