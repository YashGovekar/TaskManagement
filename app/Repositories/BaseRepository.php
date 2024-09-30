<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;

/**
 * Define basic methods for repository.
 */
class BaseRepository
{
    protected Model $model;

    /**
     * Define basic model for repository.
     */
    public function __construct($model)
    {
        $this->model = new $model;
    }

    /**
     * Basic method for getting records from database.
     */
    public function fetchAll($paginate, $fields): Collection|LengthAwarePaginator
    {
        // Check if pagination is requested.
        if (! empty($paginate)) {
            return $this->model->select($fields)->paginate($paginate);
        }

        // Return all records.
        return $this->model->get($fields);
    }

    /**
     * Basic method for getting a record of model from database.
     */
    public function fetch(Model $project)
    {
        return $this->model->find($project->id);
    }

    /**
     * Basic method for creating a model.
     */
    public function create($data): ?Model
    {
        $this->model->fill($data);

        try {
            $this->model->save();

            return $this->model;
        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return null;
        }
    }

    /**
     * Basic method for updating a model.
     */
    public function update($model, $data): Model|bool
    {
        $model->fill($data);

        try {
            $model->save();

            return $model;
        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return false;
        }
    }

    /**
     * Basic method for deleting a model.
     */
    public function delete($model): bool
    {
        try {
            $model->delete();

            return true;
        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return false;
        }
    }
}
