<?php

namespace App\Repositories\EloquentReadRepositories;

use App\Contracts\ReadRepositories\TaskReadRepositoryInterface;
use App\Enums\TaskStatus;
use App\Models\Task;
use Illuminate\Support\Collection;

class TaskReadRepository implements TaskReadRepositoryInterface
{
    /**
     * Get all tasks based on filters.
     *
     * @param array $filters
     * @return Collection
     */
    public function getAll(array $filters): Collection
    {
        $query = Task::query();
        if (isset($filters['status'])) {
            $status = $filters['status'];
            if (in_array($status, [TaskStatus::TODO, TaskStatus::IN_PROGRESS, TaskStatus::DONE])) {
                $query->where('status', $status);
            }
        }

        if (isset($filters['date'])) {
            $date = $filters['date'];
            $query->whereDate('created_at', $date);
        }
        return $query->get()->map(function ($task) {
            return [
                'id' => $task->id,
                'title' => $task->title,
                'description' => $task->description,
                'status' => $task->status,
                'created_at' => $task->created_at,
            ];
        });
    }

    /**
     * Get a task by ID.
     *
     * @param int $taskId
     * @return Task|null
     */
    public function getById(int $taskId): ?Task
    {
        return Task::find($taskId);
    }
}


