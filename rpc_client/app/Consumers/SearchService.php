<?php
declare(strict_types=1);

namespace App\Consumers;


interface SearchService
{
    public function getUserName(int $userId) :string;
}