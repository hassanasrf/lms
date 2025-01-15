<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\User;
use App\Helpers\Constant;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\BaseController;
use App\Repository\Contracts\UserRepositoryInterface;

class UserController extends BaseController
{
    public function __construct(
        public readonly UserRepositoryInterface $repo)
    {
        if (!auth()->guard('admin')->check()) {
            $this->middleware('permission:user-read', ['only' => ['index','show']]);
            $this->middleware('permission:user-create', ['only' => 'store']);
            $this->middleware('permission:user-update', ['only' => 'update']);
            $this->middleware('permission:user-delete', ['only' => 'destroy']);
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $paginate = $request->boolean('paginate', true);
            $perPage = (int) $request->get('perPage', 10);
            $where = !auth()->guard('admin')->check() ? [['company_id', auth()->user()->company_id]] : [];
            $relations = ['company'];
            $response = $this->repo->all(where: $where, relations: $relations, paginate: $paginate, perPage: $perPage);

            return successResponse($response, Constant::MESSAGE_FETCHED, $paginate);
        } catch (\Exception $e) {
            return errorResponse($e->getMessage(),$e->getCode());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        try {
            $response = $this->repo->createUser($request->validated());
            return successResponse($response, Constant::MESSAGE_CREATED);
        } catch (Exception $e) {
            return errorResponse($e->getMessage(),$e->getCode());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        try {
            $relations = ['company'];
            $response = $this->repo->showModel($user, $relations);
            return successResponse($response, Constant::MESSAGE_FETCHED);
        } catch (Exception $e) {
            return errorResponse($e->getMessage(),$e->getCode());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function update(UserRequest $request, User $user)
    {
        try {
            $response = $this->repo->updateUser($user, $request->validated());
            return successResponse($response, Constant::MESSAGE_UPDATED);
        } catch (Exception $e) {
            return errorResponse($e->getMessage(),$e->getCode());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        try {
            $this->repo->deleteByModel($user);
            return successResponse(true,  Constant::MESSAGE_DELETED);
        } catch (Exception $e) {
            return errorResponse($e->getMessage(),$e->getCode());
        }
    }

    public function updateProfile(UserRequest $request)
    {
        try {
            $user = $this->repo->profileUpdate($request->validated());
            return successResponse($user, Constant::MESSAGE_UPDATED);
        } catch (Exception $e) {
            return errorResponse($e->getMessage());
        }
    }
}
