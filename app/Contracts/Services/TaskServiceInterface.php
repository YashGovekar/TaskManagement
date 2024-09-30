<?php

namespace App\Contracts\Services;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

interface TaskServiceInterface
{
    public function fetchAll($paginate = null, $fields = ['*']): Collection|LengthAwarePaginator;

    public function fetch(Model $project): Model;

    public function update(Model $project, array $validate);

    public function delete(Model $project);

    public function create(array $data): ?Model;

    public function updatePriority(int $old_priority, int $new_priority): bool;
}
