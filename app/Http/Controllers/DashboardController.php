<?php

namespace App\Http\Controllers;

use App\Contracts\Services\TaskServiceInterface;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    public function __construct(protected TaskServiceInterface $taskService) {}

    /**
     * Get all tasks from database and view Dashboard.
     */
    public function index(): Response
    {
        $tasks = $this->taskService->fetchAll()->load('project');

        return Inertia::render('Dashboard', compact('tasks'));
    }
}
