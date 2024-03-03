<?php

namespace App\Services;

use App\Contracts\ReadRepositories\TaskReadRepositoryInterface;
use App\Contracts\WriteRepositories\TaskWriteRepositoryInterface;
use App\Models\Task;
use Illuminate\Support\Collection;

class TaskService implements TaskServiceInterface
{
    protected TaskReadRepositoryInterface $readRepository;
    protected TaskWriteRepositoryInterface $writeRepository;

    /**
     * @param TaskReadRepositoryInterface $readRepository
     * @param TaskWriteRepositoryInterface $writeRepository
     */
    public function __construct(TaskReadRepositoryInterface $readRepository, TaskWriteRepositoryInterface $writeRepository)
    {
        $this->readRepository = $readRepository;
        $this->writeRepository = $writeRepository;
    }

    /**
     * @param array $filters
     * @return Collection
     */
    public function getAllTasks(array $filters): Collection
    {
        return $this->readRepository->getAll($filters);
    }

    /**
     * @param array $data
     * @return Task
     */
    public function createTask(array $data): Task
    {
        return $this->writeRepository->create($data);
    }

    /**
     * @param int $taskId
     * @return Task|null
     */
    public function getTaskById(int $taskId): ?Task
    {
        return $this->readRepository->getById($taskId);
    }

    /**
     * @param Task $task
     * @param array $data
     * @return Task
     */
    public function updateTask(Task $task, array $data): Task
    {
        return $this->writeRepository->update($task, $data);
    }

    /**
     * @param Task $task
     * @return void
     */
    public function deleteTask(Task $task): void
    {
        $this->writeRepository->delete($task);
    }
}