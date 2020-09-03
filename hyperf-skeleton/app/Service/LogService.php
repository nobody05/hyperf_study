<?php
declare(strict_types=1);

namespace App\Service;

use Hyperf\Logger\LoggerFactory;

/**
 * Class LogService
 * @package App\Service
 */
class LogService
{
    protected $logger;
    public function __construct(LoggerFactory $loggerFactory)
    {
        $this->logger = $loggerFactory->get('hyperf');
    }

    public function log($msg, $context = [])
    {
        $this->logger->info($msg, $context);
    }

}