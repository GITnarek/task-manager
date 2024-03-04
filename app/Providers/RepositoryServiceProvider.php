<?php

namespace App\Providers;

use App\Contracts\ReadRepositories\TaskReadRepositoryInterface;
use App\Contracts\WriteRepositories\TaskWriteRepositoryInterface;
use App\Repositories\EloquentReadRepositories\TaskReadRepository;
use App\Repositories\EloquentWriteRepositories\TaskWriteRepository;
use App\Services\TaskService;
use App\Services\TaskServiceInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(
            TaskReadRepositoryInterface::class,
            TaskReadRepository::class
        );

        $this->app->bind(
            TaskWriteRepositoryInterface::class,
            TaskWriteRepository::class,
        );

        $this->app->bind(
            TaskServiceInterface::class,
            TaskService::class
        );
    }
}
