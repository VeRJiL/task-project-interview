<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    public function run(): void
    {
        $tasks = [
			['name' => 'First Task', 'priority' => 1, 'created_at' => now()],
			['name' => 'Second Task', 'priority' => 2, 'created_at' => now()],
			['name' => 'Third Task', 'priority' => 3, 'created_at' => now()],
			['name' => 'Forth Task', 'priority' => 4, 'created_at' => now()],
			['name' => 'Fifth Task', 'priority' => 5, 'created_at' => now()],
        ];
		
		Task::insert($tasks);
    }
}
