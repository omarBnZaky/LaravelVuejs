<?php


namespace App\Backend\User;


use App\Backend\Helper\Constant;
use App\Backend\Helper\Functions;
use App\Backend\Repositories\TaskRepository;
use Illuminate\Support\Facades\Hash;
use Exception;
class Task
{
    private $taskRepo;
    private $taskModel;

    public function __construct(
        TaskRepository $taskRepo,
        \App\Task $taskModel
    )
    {
        $this->taskModel = $taskModel;
        $this->taskRepo = $taskRepo;
    }

    public function find($task_id = null)
    {
        $task = $this->taskRepo
            ->getTaskById(request('id') ?? $task_id)
            ->getTaskByHashId(request('hash_id') ?? $task_id)
            ->firstTask();

        if (empty($task)) {
            throw new Exception();
        }
        return $task;
    }

    public function allUserTasks($user_id,$pagination)
    {
        return $this->taskRepo->paginateUserTasks($user_id,$pagination);
    }


    public function finish(\App\Task $task)
    {
        try {
            $task->update([
                'status' =>Constant::FINISHED ,
            ]);

        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
        return $task;
    }

    public function doing(\App\Task $task)
    {
        try {
            $task->update([
                'status' =>Constant::DOING ,
            ]);

        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
        return $task;
    }

}
