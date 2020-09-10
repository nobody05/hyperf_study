<?php
declare(strict_types=1);

namespace App\Crontabs;


use App\Service\ExportService;
use App\Service\ExportTaskService;
use App\Service\LogService;
use App\Service\UserService;
use App\Utils\Constants;
use Hyperf\Crontab\Annotation\Crontab;

/**
 * Class ExcelExport
 * @package App\Crontabs
 *
 * @Crontab(
 *     name="excel-export",
 *     rule="*\/1 * * * *",
 *     callback="exportHandle",
 *     memo="表格导出计划任务"
 *
 * )
 */
class ExcelExport
{
    protected $exportTaskService;
    protected $userService;
    protected $exportService;
    protected $logService;

    public function __construct(
        ExportTaskService $exportTaskService,
        UserService $userService,
        ExportService $exportService,
        LogService $logService
    ){
        $this->exportTaskService = $exportTaskService;
        $this->userService = $userService;
        $this->exportService = $exportService;
        $this->logService = $logService;
    }

    /**
     *
     */
    public function exportHandle()
    {
        // 获取一个任务
        $taskInfo = $this->exportTaskService->getWaitProcessTask();
        if (empty($taskInfo)) {
            $this->logService->log("taks-is-empty");
            return true;
        }
        // 更新为处理中
        if ($this->exportTaskService->updateStatusProcessing($taskInfo['id'])) {
            $this->logService->log("task-export-start". $taskInfo['id'], [$taskInfo]);
            // 根据条件查询数据
            if ($taskInfo['type'] == Constants::EXPORT_TASK_TYPE_USER) {
                $filter = json_decode($taskInfo['export_filters'], true);
                $dataList = $this->userService->getUserListById($filter['minId'], $filter['maxId']);
                $this->logService->log("get-user-list". $taskInfo['id'], [$dataList, $taskInfo]);
                $saveFile = '/excel/用户列表'.date("YmdHis"). '.xlsx';
                $fileName = BASE_PATH. '/public'. $saveFile;
                // 导出
                try {
                    $this->exportService->export($this->userService->getExportHeaders(), $dataList, $fileName);
                } catch (\Throwable $throwable) {
                    $this->logService->log("err", [
                        $throwable->getMessage(),
                        $throwable->getFile(),
                        $throwable->getLine()
                    ]);

                    return false;
                }
                // 完成
                $this->exportTaskService->updateStatusSuccess($taskInfo['id'], $saveFile);

                $this->logService->log("task-export-success". $taskInfo['id'], [$taskInfo]);
            }
        } else {
            $this->logService->log("task-status-err". $taskInfo['id'], [$taskInfo]);
        }
    }

}