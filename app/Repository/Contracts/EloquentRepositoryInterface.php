<?php

namespace App\Repository\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface EloquentRepositoryInterface
{

    /**
     * Get first record
     *
     * @param array $columns
     * @param array $relations
     * @param array $where
     * @return Model
     */

    public function getFirst(array $columns = ['*'], array $relations = [], array $where = []);

    /**
     * Get all models.
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
    public function all(int $perPage, bool $paginate, array $columns = ['*'], array $where = [], array $relations = [], string $orderByColumn = 'id', string $orderByDirection = 'asc'): ?Object;

    /**
     * Get all trashed models.
     *
     * @return Collection
     */
    public function allTrashed(): Collection;

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
    ): ?Model;

    /**
     * Find trashed model by id.
     *
     * @param int $modelId
     * @return Model
     */
    public function findTrashedById(int $modelId): ?Model;

    /**
     * Find only trashed model by id.
     *
     * @param int $modelId
     * @return Model
     */
    public function findOnlyTrashedById(int $modelId): ?Model;

    /**
     * Create a model.
     *
     * @param array $payload
     * @return Model
     */
    public function create(array $payload): ?Model;

    /**
     * Update existing model.
     *
     * @param int $modelId
     * @param array $payload
     * @return bool
     */
    public function update(int $modelId, array $payload): bool;

    /**
     * Delete model by id.
     *
     * @param int $modelId
     * @return bool
     */
    public function deleteById(int $modelId): bool;

    /**
     * Restore model by id.
     *
     * @param int $modelId
     * @return bool
     */
    public function restoreById(int $modelId): bool;

    /**
     * Permanently delete model by id.
     *
     * @param int $modelId
     * @param array $relations
     * @return bool
     */
    public function permanentlyDeleteById(int $modelId, array $relations = []): bool;

    /**
     * Show model
     *
     * @param Model $model
     * @param array $relations
     * @param bool $isResource
     * @return Model|JsonResource
     *
     */
    public function showModel(Model $model, array $relations = [], bool $isResource = true);

    /**
     * Update model
     *
     * @param Model $model
     * @param array $payload
     * @return bool
     *
     */
    public function updateModel(Model $model, array $payload): bool;

    /**
     * Delete by model
     * @param Model $model
     * @return bool
     *
     */
    public function deleteByModel(Model $model): bool;
}
