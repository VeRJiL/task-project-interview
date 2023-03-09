<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Contracts\Foundation\Application as ApplicationAlias;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class HomePageController extends Controller
{
	public function show(): View|Application|Factory|ApplicationAlias
	{
		return view("home", [
			'tasks' => Task::query()->orderBy('priority', 'desc')->get(),
			'task' => null,
			'saveUrl' => route('task.store')
		]);
    }
}
