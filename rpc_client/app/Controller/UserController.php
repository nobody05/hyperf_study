<?php
declare(strict_types=1);

namespace App\Controller;

use App\Consumers\SearchService;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\GetMapping;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;

/**
 * Class UserController
 * @package App\Controller
 *
 * @Controller(prefix="user")
 */
class UserController extends AbstractController
{
    /**
     * @Inject
     * @var SearchService
     *
     */
    protected $serchService;

    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @return
     *
     * @GetMapping(path="showName")
     */
    public function getUserName(RequestInterface $request, ResponseInterface $response)
    {
        $userId = (int) $request->input("userId", 0);

        if (empty($userId)) return $response->json([
            'code' => 999,
            'msg' => 'userId不能为空'
        ]);

        $name = $this->serchService->getUserName($userId);

        return $response->json([
            'code' => 1000,
            'msg' => '',
            'data' => [
                'name' => $name
            ]
        ]);



    }

}