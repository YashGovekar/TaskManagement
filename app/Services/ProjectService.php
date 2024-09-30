<?php

namespace App\Services;

use App\Contracts\Repositories\ProjectRepositoryInterface;
use App\Contracts\Services\ProjectServiceInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class ProjectService implements ProjectServiceInterface
{
    public function __construct(protected ProjectRepositoryInterface $projectRepository) {}

    public function fetchAll($paginate = null, $fields = ['*']): Collection|LengthAwarePaginator
    {
        return $this->projectRepository->fetchAll($paginate, $fields);
    }

    public function fetch(Model $project): Model
    {
        return $this->projectRepository->fetch($project);
    }

    public function update(Model $project, array $validate): Model|bool
    {
        return $this->projectRepository->update($project, $validate);
    }

    public function delete(Model $project): bool
    {
        return $this->projectRepository->delete($project);
    }

    public function create(array $data): Model|bool
    {
        return $this->projectRepository->create($data);
    }
}
