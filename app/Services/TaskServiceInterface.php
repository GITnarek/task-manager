<?php

namespace App\Services;

use App\Models\Task;
use Illuminate\Support\Collection;

interface TaskServiceInterface
{
    /**
     * Get all tasks based on filters.
     *
     * @param array $filters
     * @return Collection
     */
    public function getAllTasks(array $filters): Collection;

    /**
     * Create a new task.
     *
     * @param array $data
     * @return Task
     */
    public function createTask(array $data): Task;

    /**
     * Get a task by its ID.
     *
     * @param int $taskId
     * @return Task|null
     */
    public function getTaskById(int $taskId): ?Task;

    /**
     * Update a task with new data.
     *
     * @param Task $task
     * @param array $data
     * @return Task
     */
    public function updateTask(Task $task, array $data): Task;

    /**
     * Delete a task.
     *
     * @param Task $task
     * @return void
     */
    public function deleteTask(Task $task): void;
}
