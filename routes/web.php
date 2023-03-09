<?php

use App\Http\Controllers\HomePageController;
use App\Http\Controllers\Task\CreateTaskController;
use App\Http\Controllers\Task\EditTaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomePageController::class, 'show'])->name('home');
Route::get("/tasks/{task}", [EditTaskController::class, 'edit'])->name('task.edit');
Route::put("/tasks/{task}", [EditTaskController::class, 'update'])->name('task.update');
Route::post("/tasks", [CreateTaskController::class, 'store'])->name('task.store');

