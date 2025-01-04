<?php

namespace App\Repository\Contracts;

use Illuminate\Http\Request;
use App\Http\Resources\RoleResource;
use Illuminate\Database\Eloquent\Model;

interface RoleRepositoryInterface extends EloquentRepositoryInterface
{
    public function createRole(array $data): RoleResource;

    public function updateRole(Model $model, array $data): bool;
}