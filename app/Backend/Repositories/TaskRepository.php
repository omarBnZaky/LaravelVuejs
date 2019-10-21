<?php


namespace App\Backend\Repositories;


use App\Backend\Helper\Constant;
use App\Task;
use Illuminate\Support\Facades\Auth;

class TaskRepository
{
    private $taskModel;

    /**
     * UserRepository constructor.
     */
    public function __construct(Task $taskModel)
    {
        $this->taskModel = $taskModel->newQuery();
    }

    public function newQuery()
    {
        $this->taskModel = $this->taskModel->newModelInstance();

        return $this;
    }

    public function getTaskById($id)
    {
        $this->taskModel = $this->taskModel->where('id', $id);

        return $this;
    }

    public function getTaskByHashId($hash_id)
    {
        $this->taskModel = $this->taskModel->orWhere('hash_id', $hash_id);

        return $this;
    }

    public function count()
    {
        return $this->taskModel->count();
    }

    public function firstTask()
    {
        return $this->taskModel->first();
    }


    public function getTask()
    {
        return $this->taskModel->get();
    }

    public function latestTasks()
    {
        return $this->taskModel->latest();
    }

    public function paginateTasks($pagination){

        return $this->taskModel->paginate($pagination);
    }

    public function paginateUserTasks($user_id,$pagination)
    {
        return $this->taskModel
            ->where('user_id',$user_id)
            ->paginate($pagination);
    }
}
