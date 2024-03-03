<?php

namespace App\Contracts\WriteRepositories;

use App\Models\Task;

interface TaskWriteRepositoryInterface
{
    /**
     * @param array $data
     * @return Task
     */
    public function create(array $data): Task;

    /**
     * @param Task $task
     * @param array $data
     * @return Task
     */
    public function update(Task $task, array $data): Task;

    /**
     * @param Task $task
     * @return void
     */
    public function delete(Task $task): void;
}
