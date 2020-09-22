<?php
declare(strict_types=1);

namespace App\Consumers\Impl;


use App\Consumers\SearchService;
use Hyperf\RpcClient\AbstractServiceClient;

class SearchServiceImpl extends AbstractServiceClient implements SearchService
{
    /**
     * @var string
     */
    protected $serviceName = "SearchService";

    protected $protocol = "jsonrpc";

    public function getUserName(int $userId) :string
    {
        return $this->__request(__FUNCTION__, [$userId]);
    }



}