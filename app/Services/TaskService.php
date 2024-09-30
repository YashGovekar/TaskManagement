<?php

namespace App\Services;

use App\Contracts\Repositories\TaskRepositoryInterface;
use App\Contracts\Services\TaskServiceInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class TaskService implements TaskServiceInterface
{
    public function __construct(protected TaskRepositoryInterface $taskRepository) {}

    public function fetchAll($paginate = null, $fields = ['*']): Collection|LengthAwarePaginator
    {
        return $this->taskRepository->fetchAll($paginate, $fields)->sortBy('priority', SORT_NUMERIC)->values();
    }

    public function fetch(Model $project): Model
    {
        return $this->taskRepository->fetch($project);
    }

    public function update(Model $project, array $validate): Model|bool
    {
        return $this->taskRepository->update($project, $validate);
    }

    public function delete(Model $project): bool
    {
        return $this->taskRepository->delete($project);
    }

    public function create(array $data): ?Model
    {
        return $this->taskRepository->create($data);
    }

    public function updatePriority(int $old_priority, int $new_priority): bool
    {
        return $this->taskRepository->updatePriority($old_priority, $new_priority);
    }
}
