<?php

namespace App\Http\Controllers\Api\Admin;

use Exception;
use App\Models\Commodity;
use App\Helpers\Constant;
use Illuminate\Http\Request;
use App\Http\Requests\CommodityRequest;
use App\Http\Controllers\BaseController;
use App\Repository\Contracts\CommodityRepositoryInterface;

class CommodityController extends BaseController
{
    public function __construct(
        public readonly CommodityRepositoryInterface $repo)
    {
        $this->middleware('permission:commodity-read', ['only' => ['index','show']]);
        $this->middleware('permission:commodity-create', ['only' => 'store']);
        $this->middleware('permission:commodity-update', ['only' => 'update']);
        $this->middleware('permission:commodity-delete', ['only' => 'destroy']);
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
            return errorResponse($e->getMessage(), $e->getCode());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CommodityRequest $request)
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
    public function show(Commodity $commodity)
    {
        try {
            $response = $this->repo->showModel($commodity);
            
            return successResponse($response, Constant::MESSAGE_FETCHED);
        } catch (Exception $e) {
            return errorResponse($e->getMessage(),$e->getCode());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CommodityRequest $request, Commodity $commodity)
    {
        // TODO
        try {
            $data = $request->validated();
            $response = $this->repo->updateModel($commodity, $data);

            return successResponse($response, Constant::MESSAGE_UPDATED);
        } catch (Exception $e) {
            return errorResponse($e->getMessage(),$e->getCode());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Commodity $commodity)
    {
        try {
            $this->repo->deleteByModel($commodity);

            return successResponse(true, Constant::MESSAGE_DELETED);
        } catch (Exception $e) {
            return errorResponse($e->getMessage(),$e->getCode());
        }
    }
}
