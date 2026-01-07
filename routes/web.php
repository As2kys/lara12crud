<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Models\Task;

Route::get('/',                 [App\Http\Controllers\PageController::class, 'index']);
Route::get('tasks',             [TaskController::class, 'index']);
Route::get('tasks/{task}', function (Task $task) {
    return view('tasks/view', compact('task'));
})->name('tasks.view');
Route::post('tasks/create',     [TaskController::class, 'create']);
Route::match(['post', 'put'], 'tasks/update', [TaskController::class, 'update']);
Route::match(['delete', 'post'], 'tasks/delete', [TaskController::class, 'delete']);