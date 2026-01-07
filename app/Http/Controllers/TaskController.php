<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskStatus;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::select()
            ->with('status')
            ->get();
        
        $statuses = TaskStatus::pluck('name', 'id')->toArray();
        ksort($statuses);
        
        return view('tasks.index', [
            'tasks'     => $tasks,
            'statuses'  => $statuses,
        ]);
    }

    /**
     * Creating a new task.
     */
    public function create(Request $request)
    {
        if (strlen($request->post('title', '')) > 2) {
            $task = new Task([
                'title'         => $request->post('title'),
                'description'   => $request->post('description'),
                'status_id'     => $request->post('status_id'),
                'created_at'    => date('Y-m-d H:i:s'),
            ]);
            $task->save();
            return redirect()->route('tasks.view', ['task' => $task->id]);
        }
        abort(406, 'Не указано название задачи');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (intval($request->task_id) && ($task = Task::findOrFail($request->task_id))) {
            $validatedData = $request->validate([
                'title' => 'required',
                'status_id' => 'required',
            ]);

            $task->title        =  $request->title;
            $task->description  =  $request->description;
            $task->status_id    = $request->status_id;
            $task->save();

            return json_encode(['result' => 'success']);
        }
        abort(406, 'Недостаточно входных данных?');
    }

    /**
     * Update the specified task.
     */
    public function update(Request $request, Task $task)
    {
        if ($task = Task::findOrFail($request->post('task_id', null))) {
            if (!empty($request->post('update'))) {
                $validatedData = $request->validate([
                    'title' => 'required',
                    'status_id' => 'required',
                ]);

                $task->title        = $request->title;
                $task->description  = $request->description;
                $task->status_id    = $request->status_id;
                $task->updated_at   = date('Y-m-d H:i:s');
                $task->save();

                return redirect()->route('tasks.view', ['task' => $task->id]);
            }

            $statuses = TaskStatus::pluck('name', 'id')->toArray();
            ksort($statuses);
            
            return view('tasks/update', [
                'task'      => $task,
                'statuses'  => $statuses,
            ]);
        }
    }

    /**
     * Delete task.
     */
    public function delete(Request $request)
    {
        if ($task = Task::findOrFail($request->post('task_id', null))) {
            $task->delete();
            return redirect('tasks');
        }
        abort(404);
    }
}
