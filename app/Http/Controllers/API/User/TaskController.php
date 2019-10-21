<?php

namespace App\Http\Controllers\API\User;

use App\Backend\User\Task;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;

class TaskController extends Controller
{
    private $task;

    public function __construct(Task $task)
    {
        $this->middleware('api');
        $this->task = $task;
    }

    public function index()
    {
        $user_id = Auth::guard('api')->user()->id;

        $tasks = $this->task->allUserTasks($user_id,5);

        return response($tasks);
    }

    public function finish($id)
    {
        try{
            $task = $this->task->find($id);
            $this->task->finish($task);
        }catch (Exception $exception){
            return response($exception->getMessage());
        }
    }

    public function doing($id)
    {
        try{
            $task = $this->task->find($id);
            $this->task->doing($task);
        }catch (Exception $exception){
            return response($exception->getMessage());
        }
    }


}
