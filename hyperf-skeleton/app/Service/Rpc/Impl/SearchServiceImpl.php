<?php
declare(strict_types=1);

namespace App\Service\Rpc\Impl;


use App\Service\Rpc\SearchService;
use App\Service\UserService;
use Hyperf\Di\Annotation\Inject;
use Hyperf\RpcServer\Annotation\RpcService;

/**
 * Class SearchService
 * @package App\Service\Rpc
 *
 *
 * @RpcService(
 *     name="SearchService",
 *     server="jsonrpc",
 *     protocol="jsonrpc",
 *     publishTo="consul"
 *
 *
 * )
 */
class SearchServiceImpl implements SearchService
{
    /**
     * @Inject
     * @var UserService
     */
    private $userService;

    public function getUserName(int $userId) :string
    {
        print_r($userId);

        $name = $this->userService->getNameById($userId);

        print_r($name);

        return $name;
    }

}