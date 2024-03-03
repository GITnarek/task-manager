<?php

namespace App\Http\Controllers;

use App\Services\TaskServiceInterface;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    protected TaskServiceInterface $taskService;

    /**
     * @param TaskServiceInterface $taskService
     */
    public function __construct(TaskServiceInterface $taskService)
    {
        $this->taskService = $taskService;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $filters = [
            'status' => $request->input('status'),
            'date' => $request->input('date')
        ];

        $tasks = $this->taskService->getAllTasks($filters);

        return response()->json($tasks);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $task = $this->taskService->createTask($request->all());
            return response()->json($task, 201);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function show(int $taskId): JsonResponse
    {
        $task = $this->taskService->getTaskById($taskId);

        if (!$task) {
            return response()->json(['error' => 'Task not found'], 404);
        }

        return response()->json($task);
    }

    /**
     * @param Request $request
     * @param int $taskId
     * @return JsonResponse
     */
    public function update(Request $request, int $taskId): JsonResponse
    {
        $task = $this->taskService->getTaskById($taskId);

        if (!$task) {
            return response()->json(['error' => 'Task not found'], 404);
        }

        try {
            $task = $this->taskService->updateTask($task, $request->all());
            return response()->json($task);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * @param int $taskId
     * @return JsonResponse
     */
    public function destroy(int $taskId): JsonResponse
    {
        $task = $this->taskService->getTaskById($taskId);

        if (!$task) {
            return response()->json(['error' => 'Task not found'], 404);
        }

        try {
            $this->taskService->deleteTask($task);
            return response()->json(null, 204);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
