<?php

namespace App\Http\Controllers\Api\Admin;

use Exception;
use App\Helpers\Constant;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Http\Requests\PermissionRequest;
use Spatie\Permission\Models\Permission;
use App\Repository\Contracts\PermissionRepositoryInterface;

class PermissionController extends BaseController
{
    public function __construct(
        public readonly PermissionRepositoryInterface $repo)
    {
        // $this->middleware('permission:permission-read', ['only' => ['show']]);
        $this->middleware('permission:permission-create', ['only' => 'store']);
        $this->middleware('permission:permission-update', ['only' => 'update']);
        $this->middleware('permission:permission-delete', ['only' => 'destroy']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $paginate = $request->boolean('paginate', true);
            $perPage = (int) $request->get('perPage', 10);
            $response = $this->repo->all(paginate: $paginate, perPage: $perPage);
            return successResponse($response, Constant::MESSAGE_FETCHED, $paginate);
        } catch (Exception $e) {
            return errorResponse($e->getMessage(),$e->getCode());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PermissionRequest $request)
    {
        try {
            $response = $this->repo->create($request->validated());
            return successResponse($response, Constant::MESSAGE_CREATED);
        } catch (Exception $e) {
            return errorResponse($e->getMessage(),$e->getCode());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Permission $permission)
    {
        try {
            $response = $this->repo->showModel($permission);
            return successResponse($response, Constant::MESSAGE_FETCHED);
        } catch (Exception $e) {
            return errorResponse($e->getMessage(),$e->getCode());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PermissionRequest $request, Permission $permission)
    {
        // TODO
        try {
            $data = $request->validated();
            $response = $this->repo->updateModel($permission, $data);
            return successResponse($response, Constant::MESSAGE_UPDATED);
        } catch (Exception $e) {
            return errorResponse($e->getMessage(),$e->getCode());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission)
    {
        try {
            $this->repo->deleteByModel($permission);
            return successResponse(true, Constant::MESSAGE_DELETED);
        } catch (Exception $e) {
            return errorResponse($e->getMessage(),$e->getCode());
        }
    }
}
