<?php

namespace App\Repository\Contracts;

use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Illuminate\Database\Eloquent\Model;

interface UserRepositoryInterface extends EloquentRepositoryInterface
{
    /**
     * profileUpdate
     *
     * @param array $data
     * @return UserResource
     */
    public function profileUpdate(array $data): UserResource;
}
