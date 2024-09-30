<?php

namespace App\Providers;

use App\Contracts;
use App\Repositories;
use App\Services;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Register Project Service and Repository
        $this->app->bind(Contracts\Services\ProjectServiceInterface::class, Services\ProjectService::class);
        $this->app->bind(Contracts\Repositories\ProjectRepositoryInterface::class, Repositories\ProjectRepository::class);

        // Register Task Service and Repository
        $this->app->bind(Contracts\Services\TaskServiceInterface::class, Services\TaskService::class);
        $this->app->bind(Contracts\Repositories\TaskRepositoryInterface::class, Repositories\TaskRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Vite::prefetch(concurrency: 3);
    }
}
