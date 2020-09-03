<?php
declare(strict_types=1);

namespace App\Aspect;


use App\Service\LogService;
use Hyperf\Di\Annotation\Aspect;
use Hyperf\Di\Aop\AbstractAspect;
use Hyperf\Di\Aop\ProceedingJoinPoint;

/**
 * Class TestAspect
 * @package App\Aspect
 *
 *
 * @Aspect(
 *     classes={
 *          "App\Service\LoginService::login",
 *          "App\Controller\AopTestController::login",
 *
 *     },
 *     priority=1
 *
 * )
 */
class TestAspect extends AbstractAspect
{
    protected $logService;
    public function __construct(LogService $logService)
    {
        $this->logService = $logService;
    }

    public function process(ProceedingJoinPoint $proceedingJoinPoint)
    {
        // 执行之前进行通知
        $this->logService->log('get-request to '. $proceedingJoinPoint->className. '::'. $proceedingJoinPoint->methodName);

        // 执行切点方法 也就是上面声明的login方法
        $result = $proceedingJoinPoint->process();

        // 执行之后通知
        $this->logService->log('get-result from '. $proceedingJoinPoint->className. '::'. $proceedingJoinPoint->methodName, $result);

        return $result;

    }

}