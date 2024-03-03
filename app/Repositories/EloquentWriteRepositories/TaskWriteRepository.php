<?php

namespace App\Repositories\EloquentWriteRepositories;

use App\Contracts\WriteRepositories\TaskWriteRepositoryInterface;
use App\Models\Task;

class TaskWriteRepository implements TaskWriteRepositoryInterface
{
    /**
     * @param array $data
     * @return Task
     */
    public function create(array $data): Task
    {
        return Task::create($data);
    }

    /**
     * @param Task $task
     * @param array $data
     * @return Task
     */
    public function update(Task $task, array $data): Task
    {
        $task->update($data);
        return $task;
    }

    /**
     * @param Task $task
     * @return void
     */
    public function delete(Task $task): void
    {
        $task->delete();
    }
}
