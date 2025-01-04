<?php

namespace App\Repository\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repository\Contracts\EloquentRepositoryInterface;

class BaseRepository implements EloquentRepositoryInterface
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * @jsonResource string
     */
    protected $resource;

    /**
     * @var int
     */
    protected $pageSize;

    /**
     * BaseRepository constructor.
     *
     * @param Model $model
     */
    public function __construct(Model $model, string $resource = null, int $pageSize = 10)
    {
        $this->model = $model;
        $this->resource = $resource;
        $this->pageSize = $pageSize;
    }

    /**
     * Get first record
     *
     * @param array $columns
     * @param array $relations
     * @param array $where
     * @return Model
     */
    public function getFirst(array $columns = ['*'], array $relations = [], array $where = [])
    {
        $modelData = $this->model
            ->when($columns, function ($q, $columns) {
                $q->select($columns);
            })
            ->when($relations, function ($q, $relations) {
                $q->with($relations);
            })
            ->when($where, function ($q, $where) {
                $q->where($where);
            })->firstOrFail();


        return $modelData;
    }

    /**
     * Get all models
     *
     * @param int $perPage
     * @param bool $paginate
     * @param array $columns
     * @param array $where
     * @param array $relations
     * @param string $orderByColumn
     * @param string $orderByDirection
     * @return Object
     */
    public function all(int $perPage = 10, bool $paginate = false, array $columns = ['*'], array $where = [], array $relations = [], $orderByColumn = 'id', $orderByDirection = 'asc'): ?Object
    {
        $filterBy = request('filterBy');
        $searchTerm = request('filterValue');

        if ($filterBy && $searchTerm) {
            $where[] = [$filterBy, 'like', "%$searchTerm%"];
        }

        // Define a custom orderBy expression to prioritize results
        $customOrderBy = \DB::raw("CASE WHEN $orderByColumn LIKE '$searchTerm%' THEN 0 ELSE 1 END");

        $query = $this->model->select($columns)
            ->with($relations)
            ->where($where)
            ->orderBy($customOrderBy) // Apply custom sorting
            ->orderBy($orderByColumn, $orderByDirection); // Then, apply the original ordering

        $data = $paginate ? $query->paginate($perPage) : $query->get();
        return $this->resource ? $this->resource::collection($data) : $data;
    }

    /**
     * Get all trashed models.
     *
     * @return Collection
     */
    public function allTrashed(): Collection
    {
        return $this->model->onlyTrashed()->get();
    }

    /**
     * Find model by id.
     *
     * @param int $modelId
     * @param array $columns
     * @param array $relations
     * @param array $appends
     * @return Model
     */
    public function findById(
        int $modelId,
        array $columns = ['*'],
        array $relations = [],
        array $appends = []
    ): ?Model {
        return $this->model
            ->when($columns, function ($q) use ($columns) {
                $q->select($columns);
            })->when($relations, function ($q) use ($relations) {
            $q->with($relations);
        })->findOrFail($modelId)->append($appends);
    }

    /**
     * Find trashed model by id.
     *
     * @param int $modelId
     * @return Model
     */
    public function findTrashedById(int $modelId): ?Model
    {
        return $this->model->withTrashed()->findOrFail($modelId);
    }

    /**
     * Find only trashed model by id.
     *
     * @param int $modelId
     * @return Model
     */
    public function findOnlyTrashedById(int $modelId): ?Model
    {
        return $this->model->onlyTrashed()->findOrFail($modelId);
    }

    /**
     * Create a model.
     *
     * @param array $payload
     * @return Model
     */
    public function create(array $payload): ?Model
    {
        $model = $this->model->create($payload);

        return $model->fresh();
    }

    /**
     * Update existing model.
     *
     * @param int $modelId
     * @param array $payload
     * @return bool
     */
    public function update(int $modelId, array $payload): bool
    {
        $model = $this->findById($modelId);

        return $model->update($payload);
    }

    /**
     * Delete model by id.
     *
     * @param int $modelId
     * @return bool
     */
    public function deleteById(int $modelId): bool
    {
        return $this->findById($modelId)->delete();
    }

    /**
     * Delete model by id along with specified relations.
     *
     * @param int $modelId
     * @param array $relationsToDelete
     * @return bool
     */
    public function deleteByIdWithRelations(int $modelId, array $relationsToDelete = []): bool
    {
        $model = $this->findById($modelId);

        if (!empty($relationsToDelete)) {
            $model->load($relationsToDelete);

            foreach ($relationsToDelete as $relation) {
                $related = $model->$relation;
                if ($related instanceof Collection) {
                    $related->each(function ($item) {
                        $item->delete();
                    });
                } elseif ($related) {
                    $related->delete();
                }
            }
        }

        return $model->delete();
    }

    /**
     * Restore model by id.
     *
     * @param int $modelId
     * @return bool
     */
    public function restoreById(int $modelId): bool
    {
        return $this->findOnlyTrashedById($modelId)->restore();
    }

    /**
     * Restore model by id.
     *
     * @param int $modelId
     * @param array $relations
     * @return bool
     */
    public function restoreByIdWithRelations(int $modelId, array $relations = []): bool
    {
        $model = $this->findOnlyTrashedById($modelId);

        if ($model) {

            $model->restore();

            foreach ($relations as $relation) {

                $relatedModels = $model->{$relation}()->withTrashed()->get();

                if ($relatedModels instanceof Model && method_exists($relatedModels, 'restore')) {
                    $relatedModels->restore();
                } elseif ($relatedModels instanceof Collection) {
                    foreach ($relatedModels as $relatedModel) {
                        if ($relatedModel instanceof Model && method_exists($relatedModel, 'restore')) {
                            $relatedModel->restore();
                        }
                    }
                }
            }

            return true;
        }

        return false;
    }



    /**
     * Permanently delete model by id.
     *
     * @param int $modelId
     * @param array $relations
     * @return bool
     */
    public function permanentlyDeleteById(int $modelId, array $relations = []): bool
    {
        $model = $this->findById($modelId, [], $relations);

        if (!$model)
            return false;

        foreach ($relations as $key => $relation) {
            $relation = $model->$relation;

            // delete child recods
            if ($relation) {
                $this->deleteChildRecords($relation);
            }

        }

        // delete parent model
        if (method_exists($model, 'trashed')) {
            return $model->forceDelete();
        } else {
            return $model->delete();
        }
    }

    /**
     * delete child relation records
     *
     * @param object $relation
     * @return bool
     */
    protected function deleteChildRecords($relation)
    {
        $response = false;
        // is collection
        if ($relation instanceof \Illuminate\Database\Eloquent\Collection) {

            // has data
            if ($relation->count() > 0) {
                foreach ($relation as $object) {
                    if (method_exists($object, 'trashed')) {
                        $object->forceDelete();
                    } else {
                        $object->delete();
                    }
                }
                return true;
            }
        } else {

            if (method_exists($relation, 'trashed')) {
                $response = $relation->forceDelete();
            } else {
                $response = $relation->delete();
            }
        }
        return $response;
    }


    /**
     * Check if the authenticated user has a specific role.
     *
     * @param  string  $role
     * @return bool
     */
    public function userHasRole(string $role): bool
    {
        $user = auth()->user();
        return $user && $user->hasRole($role);
    }

    /**
     * Get the currently authenticated user.
     *
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function currentUser()
    {
        return auth()->user();
    }

    /**
     * Parse and extract search parameters from input data.
     *
     * This function extracts common search parameters such as search text,
     * pagination flag, page size, sorting criteria, and order direction
     * from the provided data array.
     *
     * @param array $data The input data containing search parameters.
     *
     * @return array An associative array containing the parsed search parameters:
     *               - 'searchText': The search text.
     *               - 'paginate': A boolean flag indicating whether pagination is enabled.
     *               - 'pageSize': The number of items per page (defaulting to a class property).
     *               - 'sortBy': The field to sort by.
     *               - 'orderBy': The sort order (e.g., 'asc' or 'desc').
     */
    public function parseSearchParameters($data)
    {
        $searchText = $data['search'] ?? '';
        $paginate = $data['paginate'] ?? false;
        $pageSize = $data['page_size'] ?? $this->pageSize;
        $sortBy = $data['sort_by'] ?? null;
        $orderBy = $data['order_by'] ?? null;

        return compact('searchText', 'paginate', 'pageSize', 'sortBy', 'orderBy');
    }

    /**
     * Show model
     * @param Model $model
     * @param array $relations
     * @param bool $isResource
     * @return Model|JsonResource
     *
     */
    public function showModel(Model $model, array $relations = [], bool $isResource = true)
    {
        $model->load($relations);
        return $this->resource && $isResource ? $this->resource::make($model) : $model;
    }

    /**
     * Update model
     * @param Model $model
     * @param array $payload
     * @return bool
     *
     */
    public function updateModel(Model $model, array $payload): bool
    {
        unset($payload['_method']);
        return $model->update($payload);
    }

    /**
     * Delete by model
     * @param Model $model
     * @return bool
     *
     */
    public function deleteByModel(Model $model): bool
    {
        return $model->delete();
    }
}
