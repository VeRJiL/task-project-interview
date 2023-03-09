<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Models\Task;

class ChangeTaskOrderController extends Controller
{
	public function changeOrder(Task $task1, Task $task2)
	{
		$task1Priority = $task1->priority;
		$task1->priority = $task2->priority;
		$task1->save();
		
		$task2->priority = $task1Priority;
		$task2->save();
		
		return response()->json([
			'data' => [
				"task1" => $task1,
				"task2" => $task2
			],
			"message" => "Priority Swapped Successfully"
		]);
    }
}
