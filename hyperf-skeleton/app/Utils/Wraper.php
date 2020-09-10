<?php


namespace App\Utils;


trait Wraper
{
    /**
     * @param $list
     * @param $total
     * @param $page
     * @param $pageSize
     * @return array|false
     */
    public static function pageListWraper($list, $total, $page, $pageSize)
    {
        return self::successWraperDefault("success", array_combine(['list', 'total', 'page', 'pageSize'], [
            $list, $total, $page, $pageSize
        ]));
    }

    /**
     * @param string $msg
     * @param array $data
     *
     * @return array
     */
    public static function successWraperDefault($msg = "success", $data = [])
    {
        return [
            'code' => Constants::SUCCESS_CODE,
            'msg' => $msg,
            'data' => $data
        ];
    }

    /**
     * @param string $msg
     * @param array $data
     * @return array
     */
    public static function failWraperDefault($msg = "server error", $data = [])
    {
        return [
            'code' => Constants::FAIL_CODE,
            'msg' => $msg,
            'data' => $data
        ];

    }
}