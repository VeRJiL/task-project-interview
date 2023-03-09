<?php

use App\Http\Controllers\Task\ChangeTaskOrderController;
use App\Http\Controllers\Task\DeleteTaskController;
use Illuminate\Support\Facades\Route;

Route::patch("/tasks/{task1}/{task2}", [ChangeTaskOrderController::class, 'changeOrder']);
Route::delete("/tasks/{task}", [DeleteTaskController::class, 'destroy']);
