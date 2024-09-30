<?php

namespace App\Http\Controllers;

use App\Contracts\Services\ProjectServiceInterface;
use App\Contracts\Services\TaskServiceInterface;
use App\Enums\TaskStatus;
use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class TaskController extends Controller
{
    public function __construct(protected TaskServiceInterface $taskService, protected ProjectServiceInterface $projectService) {}

    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $tasks = $this->taskService->fetchAll()->load('project');

        return Inertia::render('Tasks/Index', compact('tasks'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskRequest $request): RedirectResponse
    {
        $task = $this->taskService->create(
            $request->only('name', 'priority', 'project_id', 'completion_date', 'completion_time', 'status')
        );

        if (empty($task)) {
            return redirect()->back()->withError('Task Creation Failed!');
        }

        return redirect()->back()->withSuccess('Task Created Successfully!');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        $statuses = TaskStatus::cases();
        $projects = $this->projectService->fetchAll();

        return Inertia::render('Tasks/Create', compact('statuses', 'projects'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task): Response
    {
        $statuses = TaskStatus::cases();
        $projects = $this->projectService->fetchAll();

        return Inertia::render('Tasks/Edit', compact('task', 'statuses', 'projects'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskRequest $request, Task $task): RedirectResponse
    {
        $task = $this->taskService->update(
            $task,
            $request->only('name', 'priority', 'project_id', 'completion_date', 'completion_time', 'status')
        );

        if (empty($task)) {
            return redirect()->back()->withError('Task Creation Failed!');
        }

        return redirect()->route('tasks.edit', $task->id)->withSuccess('Task Created Successfully!');
    }

    /**
     * Update the priorities of 2 records which were swapped during drag.
     */
    public function updatePriority(Request $request): RedirectResponse
    {
        $request->validate([
            'old_priority' => ['required', 'numeric'],
            'new_priority' => ['required', 'numeric'],
        ]);

        $task = $this->taskService->updatePriority($request->input('old_priority'), $request->input('new_priority'));

        if ($task) {
            return redirect()->back()->withSuccess('Task Priority Updated Successfully!');
        } else {
            return redirect()->back()->withError('Failed to update priority.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task): RedirectResponse
    {
        $delete = $this->taskService->delete($task);

        if (empty($delete)) {
            return redirect()->back()->withError('Task not deleted.');
        }

        return redirect()->route('tasks.index')->withSuccess('Task deleted successfully.');
    }
}
