<?php
declare(strict_types=1);

namespace App\Service;


use App\Model\User;
use App\Utils\Wraper;
use Hyperf\DbConnection\Db;

class UserService
{
    use Wraper;

    public function __construct()
    {
    }

    public function getUserListByIdWithPage(int $minId, int $maxId, int $page, int $pageSize = 50)
    {

        $builder = User::query()
            ->where('id', ">", $minId)
            ->where("id", "<", $maxId);

        $total = (clone $builder)->count();
        if ($total == 0) {
            return Wraper::pageListWraper([], 0, $page, $pageSize);
        }

        $list = $builder
            ->select(['id', 'nickname', 'email'])
            ->paginate($pageSize, ['*'], 'page', $page)->items();

        return Wraper::pageListWraper($list, $total, $page, $pageSize);
    }

    public function getUserListById(int $minId, int $maxId)
    {

        $builder = User::query()
            ->where('id', ">", $minId)
            ->where("id", "<", $maxId);

        $list = $builder
            ->select(['id', 'nickname', 'email'])
            ->get();

        return $list;
    }

    public function getExportHeaders()
    {
        return [
            'id' => 'ID',
            'nickname' => '昵称',
            'gender' => '性别',
            'mobile' => '手机号',
            'country' => '国家',
            'province' => '省份'
        ];
    }



}