<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\LoginService;
use App\Service\LogService;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\GetMapping;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;

/**
 * Class AopTestController
 * @package App\Controller
 *
 * @Controller(prefix="aop")
 */
class AopTestController
{
    private $logService;
    protected $loginService;

    public function __construct(LogService $logService, LoginService $loginService)
    {
        $this->logService = $logService;
        $this->loginService = $loginService;

    }

    public function index(RequestInterface $request, ResponseInterface $response)
    {
        return $response->raw('Hello Hyperf!');
    }

    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @return \Psr\Http\Message\ResponseInterface
     *
     * @GetMapping("eatbread")
     */
    public function eatBread(RequestInterface $request, ResponseInterface $response)
    {
        $this->logService->log('get-request');
        return $response->raw("真香");
    }

    /**
     * @GetMapping("login")
     *
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @return mixed
     */
    public function login(RequestInterface $request, ResponseInterface $response)
    {
        $userName = $request->input('userName');
        return $this->loginService->login($userName);
    }
}


