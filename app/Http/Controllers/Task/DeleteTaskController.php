<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\JsonResponse;

class DeleteTaskController extends Controller
{
	public function destroy(Task $task): JsonResponse
	{
		$task->delete();
		
		return response()->json([
			'message' => "Task Deleted: " . $task->name
		]);
    }
}
