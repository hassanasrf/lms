<?php

namespace App\Http\Controllers\Api\Admin;

use Exception;
use App\Models\Voyage;
use App\Helpers\Constant;
use Illuminate\Http\Request;
use App\Http\Requests\VoyageRequest;
use App\Http\Controllers\BaseController;
use App\Repository\Contracts\VoyageRepositoryInterface;

class VoyageController extends BaseController
{
    public function __construct(
        public readonly VoyageRepositoryInterface $repo)
    {
        $this->middleware('permission:voyage-read', ['only' => ['index','show']]);
        $this->middleware('permission:voyage-create', ['only' => 'store']);
        $this->middleware('permission:voyage-update', ['only' => 'update']);
        $this->middleware('permission:voyage-delete', ['only' => 'destroy']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $paginate = $request->boolean('paginate', true);
            $perPage = (int) $request->get('perPage', 10);
            $relations = ['vessel','country'];
            $response = $this->repo->all(relations: $relations, paginate: $paginate, perPage: $perPage);

            return successResponse($response, Constant::MESSAGE_FETCHED, $paginate);
        } catch (Exception $e) {
            return errorResponse($e->getMessage(), $e->getCode());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VoyageRequest $request)
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
    public function show(Voyage $voyage)
    {
        try {
            $response = $this->repo->showModel($voyage);
            
            return successResponse($response, Constant::MESSAGE_FETCHED);
        } catch (Exception $e) {
            return errorResponse($e->getMessage(),$e->getCode());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(VoyageRequest $request, Voyage $voyage)
    {
        try {
            $data = $request->validated();
            $response = $this->repo->updateModel($voyage, $data);

            return successResponse($response, Constant::MESSAGE_UPDATED);
        } catch (Exception $e) {
            return errorResponse($e->getMessage(),$e->getCode());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Voyage $voyage)
    {
        try {
            $this->repo->deleteByModel($voyage);

            return successResponse(true, Constant::MESSAGE_DELETED);
        } catch (Exception $e) {
            return errorResponse($e->getMessage(),$e->getCode());
        }
    }
}
