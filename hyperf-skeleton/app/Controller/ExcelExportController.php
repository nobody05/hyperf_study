<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\ExportService;
use App\Service\ExportTaskService;
use App\Service\UserService;
use App\Utils\Wraper;
use Hyperf\DbConnection\Db;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\GetMapping;
use Hyperf\HttpServer\Annotation\PostMapping;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;
use Hyperf\View\RenderInterface;

/**
 * Class ExcelExportController
 * @package App\Controller
 *
 * @Controller(prefix="/excel")
 */
class ExcelExportController
{
    use Wraper;

    protected $exportService;
    protected $userService;
    protected $exportTaskService;

    public function __construct(ExportService $exportService, UserService $userService, ExportTaskService $exportTaskService)
    {
        $this->exportService = $exportService;
        $this->userService = $userService;
        $this->exportTaskService = $exportTaskService;
    }

    /**
     * @param RenderInterface $render
     * @return \Psr\Http\Message\ResponseInterface
     *
     * @GetMapping(path="index")
     */
    public function index(RenderInterface $render)
    {
        return $render->render("export/index");
    }

    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     *
     * @GetMapping("userList")
     *
     *
     * @return
     */
    public function getUserList(RequestInterface $request, ResponseInterface $response)
    {
        $minId = (int) $request->input('minId', 1);
        $maxId = (int) $request->input('maxId', 20);

        $page = (int) $request->input('page', 1);
        $pageSize = (int) $request->input("pageSize", 20);

        $result = $this->userService->getUserListByIdWithPage($minId, $maxId, $page, $pageSize);

        return $response->json($result);
    }

    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @return \Psr\Http\Message\ResponseInterface
     *
     * @GetMapping("exportList")
     */
    public function exportUserList(RequestInterface $request, ResponseInterface $response)
    {
        $minId = (int) $request->input('minId');
        $maxId = (int) $request->input('maxId');

        $result = $this->exportTaskService->createTask([
            'type' => 1,
            'created_user_id' => 1,
            'export_filters' => json_encode([
                'minId' => $minId,
                'maxId' => $maxId
            ])
        ]);

        if ($result) return $response->json(Wraper::successWraperDefault("下载任务创建成功，请去下载中心下载"));
        return $response->json(Wraper::failWraperDefault("下载任务下载失败，请重新尝试"));
    }

    /**
     *
     * @GetMapping("downloadCenter")
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function downloadList(RequestInterface $request, ResponseInterface $response)
    {
        $page = (int) $request->input('page', 1);
        $pageSize = (int) $request->input('pageSize', 20);
        $result = $this->exportTaskService->getSuccessTaskWithPage($page, $pageSize);

        return $response->json($result);
    }


}
