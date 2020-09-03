<?php
declare(strict_types=1);

namespace App\Service;


class LoginService
{
    public function __construct()
    {
    }

    /**
     * @param $userName
     * @return array
     */
    public function login(string $userName)
    {
        return [
            'user' => $userName,
            'time' => date("Y-m-d H:i:s")
        ];
    }

}