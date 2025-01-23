<?php

namespace App\Http\Controllers\Api\Admin;

use Exception;
use App\Models\Vessel;
use App\Helpers\Constant;
use Illuminate\Http\Request;
use App\Http\Requests\VesselVoyRequest;
use App\Http\Controllers\BaseController;
use App\Repository\Contracts\VesselVoyRepositoryInterface;

class VesselVoyController extends BaseController
{
    public function __construct(
        public readonly VesselVoyRepositoryInterface $repo)
    {
        $this->middleware('permission:vessel-voy-read', ['only' => ['index','show']]);
        $this->middleware('permission:vessel-voy-create', ['only' => 'store']);
        $this->middleware('permission:vessel-voy-update', ['only' => 'update']);
        $this->middleware('permission:vessel-voy-delete', ['only' => 'destroy']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $paginate = $request->boolean('paginate', true);
            $perPage = (int) $request->get('perPage', 10);
            $relations = ['shippingLine','agent','voyages'];
            $response = $this->repo->all(relations: $relations, paginate: $paginate, perPage: $perPage);

            return successResponse($response, Constant::MESSAGE_FETCHED, $paginate);
        } catch (Exception $e) {
            return errorResponse($e->getMessage(), $e->getCode());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VesselVoyRequest $request)
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
    public function show(Vessel $vessel)
    {
        try {
            $response = $this->repo->showModel($vessel);
            
            return successResponse($response, Constant::MESSAGE_FETCHED);
        } catch (Exception $e) {
            return errorResponse($e->getMessage(),$e->getCode());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(VesselVoyRequest $request, Vessel $vessel)
    {
        try {
            $data = $request->validated();
            $response = $this->repo->updateModel($vessel, $data);

            return successResponse($response, Constant::MESSAGE_UPDATED);
        } catch (Exception $e) {
            return errorResponse($e->getMessage(),$e->getCode());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vessel $vessel)
    {
        try {
            $this->repo->deleteByModel($vessel);

            return successResponse(true, Constant::MESSAGE_DELETED);
        } catch (Exception $e) {
            return errorResponse($e->getMessage(),$e->getCode());
        }
    }
}
