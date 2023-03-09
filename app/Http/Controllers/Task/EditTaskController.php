<?php

namespace App\Http\Controllers\Task;

use App\Models\Task;
use App\Http\Requests\TaskRequest;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application as ApplicationAlias;

class EditTaskController extends Controller
{
	public function edit(Task $task): View|Application|Factory|ApplicationAlias
	{
		return view("home", [
			'tasks' => Task::query()->orderBy('priority', 'desc')->get(),
			'task' => $task,
			'saveUrl' => route('task.update', $task->id)
		]);
	}
	
	public function update(TaskRequest $request, Task $task): RedirectResponse
	{
		$task->update(
			$request->allowedInputs()
		);
		
		alert()->success("Task Updated: " . $task->name);
		
		return redirect()->route('home');
    }
}
