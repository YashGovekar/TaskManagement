<?php

namespace App\Http\Controllers;

use App\Contracts\Services\ProjectServiceInterface;
use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class ProjectController extends Controller
{
    public function __construct(protected ProjectServiceInterface $projectService) {}

    /**
     * Get all projects amd render.
     */
    public function index(): Response
    {
        $projects = $this->projectService->fetchAll();

        return Inertia::render('Projects/Index', compact('projects'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProjectRequest $request): RedirectResponse
    {
        $project = $this->projectService->create($request->only('name', 'description'));

        if (empty($project)) {
            return redirect()->route('projects.index')->withError('Project not created.');
        }

        return redirect()->route('projects.index')->withSuccess('Project created successfully.');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return Inertia::render('Projects/Create');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project): Response
    {
        return Inertia::render('Projects/Edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProjectRequest $request, Project $project): RedirectResponse
    {
        $project = $this->projectService->update($project, $request->only('name', 'description'));

        if (empty($project)) {
            return redirect()->route('projects.index')->withError('Project not updated.');
        }

        return redirect()->route('projects.index')->withSuccess('Project updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project): RedirectResponse
    {
        $delete = $this->projectService->delete($project);

        if (empty($delete)) {
            return redirect()->back()->withError('Project not deleted.');
        }

        return redirect()->route('projects.index')->withSuccess('Project deleted successfully.');
    }
}
