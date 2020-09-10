<?php
declare(strict_types=1);

namespace App\Service;


use App\Model\ExportTask;
use App\Utils\Constants;
use App\Utils\Wraper;
use Hyperf\Paginator\Paginator;

class ExportTaskService
{
    use Wraper;

    public function __construct()
    {
    }

    /**
     * @param $data
     * @return bool
     */
    public function createTask($data)
    {
        $exportTask = new ExportTask();
        $exportTask->created_user_id = $data['created_user_id'] ?? 1;
        $exportTask->type = $data['type'] ?? 1;
        $exportTask->export_filters = $data['export_filters'] ?? '';

        return $exportTask->save();
    }

    public function getWaitProcessTask($type = Constants::EXPORT_TASK_TYPE_USER)
    {
        return ExportTask::query()
            ->where('type', '=', $type)
            ->where('status', '=', Constants::EXPORT_TASK_STATUS_WAIT_PROCESS)
            ->orderBy("id", "asc")
            ->limit(1)
            ->get(['id', 'status', 'export_filters', 'type'])
            ->first();
    }

    /**
     * @param int $page
     * @param int $pageSize
     * @return mixed
     */
    public function getSuccessTaskWithPage(int $page, int $pageSize = 50)
    {
        $builder = ExportTask::query()
            ->where('type', '=', Constants::EXPORT_TASK_TYPE_USER)
            ->where('status', '=', Constants::EXPORT_TASK_STATUS_SUCCESS_PROCESS)
            ->orderBy("id", "asc");

        $result = $builder
            ->select(['id', 'status', 'type', 'created_user_id', 'export_file_path'])
            ->paginate($pageSize, ['*'], 'page', $page);

        return Wraper::pageListWraper($result->items(), $result->total(), $page, $pageSize);
    }

    /**
     * @param $taskId
     * @return bool
     */
    public function updateStatusProcessing($taskId)
    {
        $task = ExportTask::query()
            ->where('id', '=', $taskId)
            ->where('status', '=', Constants::EXPORT_TASK_STATUS_WAIT_PROCESS)
            ->first();
        $task->status = Constants::EXPORT_TASK_STATUS_PROCESSING;
        return $task->save();
    }

    public function updateStatusSuccess($taskId, $filePath)
    {
        $task = ExportTask::query()
            ->where('id', '=', $taskId)
            ->first();
        $task->status = Constants::EXPORT_TASK_STATUS_SUCCESS_PROCESS;
        $task->export_file_path = $filePath;

        return $task->save();
    }

    public function updateTaskById()
    {

    }

}