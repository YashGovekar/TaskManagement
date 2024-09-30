<?php

namespace App\Contracts\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

interface ProjectRepositoryInterface
{
    public function fetchAll($paginate, $fields): Collection|LengthAwarePaginator;

    public function fetch(Model $project);

    public function create($data): ?Model;

    public function update(Model $model, $data): Model|bool;

    public function delete(Model $model): bool;
}
