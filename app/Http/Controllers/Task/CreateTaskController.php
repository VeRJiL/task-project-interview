<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Http\RedirectResponse;

class CreateTaskController extends Controller
{
	public function store(TaskRequest $request): RedirectResponse
	{
		$task = Task::create($request->allowedInputs());
		
		alert()->success("Task Created: " . $task->name);
		
		return redirect()->route('home');
    }
}
