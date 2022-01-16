<?php

namespace App\Http\Controllers;

use App\Http\Resources\TasksResource;
use App\Models\Category;
use App\Models\Task;
use App\Models\User;
use App\Models\UserTask;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usersTasks = UserTask::userTasks()->get();
        $usersTasks = TasksResource::collection($usersTasks);

        return response()->json([
            'data' => [
                'tasks' => $usersTasks
            ]
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        $task = tap(UserTask::where('user_id', Auth::user()->id)->where('task_id', $task->id))
            ->update(['status' => 'completed'])
            ->first();
            
        return response()->json([
            'data' => $task,
        ], 200);
    }

    /**
     * Replace the specified task with new one for a user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function replace(Request $request, Task $task)
    {
        $task = UserTask::where('user_id', Auth::user()->id)->where('task_id', $task->id)
            ->update(['status' => 'missed']);

        $existsTasksIds = UserTask::where('user_id', Auth::user()->id)->pluck('task_id');
        $updatedTask = Task::whereNotIn('id', $existsTasksIds)->orderByRaw('RAND()')->get()->take(1);

        UserTask::create([
            'user_id' => Auth::user()->id,
            'task_id' => $updatedTask[0]->id,
            'status' => 'processed',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        
        $usersTasks = UserTask::userTasks()->get();
        $usersTasks = TasksResource::collection($usersTasks);
            
        return response()->json([
            'data' => $usersTasks,
        ], 200);
    }
}
