<?php
declare(strict_types=1);

namespace App\Service\Rpc;


interface SearchService
{
    public function getUserName(int $userId) :string;

}