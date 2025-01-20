<?php

namespace App\Http\Controllers\Api\Admin;

use Exception;
use App\Models\City;
use App\Helpers\Constant;
use Illuminate\Http\Request;
use App\Http\Requests\CityRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BaseController;
use App\Repository\Contracts\CityRepositoryInterface;

class CityController extends BaseController
{
    public function __construct(
        public readonly CityRepositoryInterface $repo)
    {
        if (!auth()->guard('admin')->check()) {
            $this->middleware('permission:city-read', ['only' => ['index','show']]);
            $this->middleware('permission:city-create', ['only' => 'store']);
            $this->middleware('permission:city-update', ['only' => 'update']);
            $this->middleware('permission:city-delete', ['only' => 'destroy']);
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
            $relations = ['country'];

            $where = [];
            if (Auth::guard('admin')->check()) {
                $where = [['company_id', NULL]];
            }

            $response = $this->repo->all(where: $where, relations: $relations, paginate: $paginate, perPage: $perPage);

            return successResponse($response, Constant::MESSAGE_FETCHED, $paginate);
        } catch (Exception $e) {
            return errorResponse($e->getMessage(), $e->getCode());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CityRequest $request)
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
    public function show(City $city)
    {
        try {
            $relations = ['country'];
            $response = $this->repo->showModel($city, $relations);
            
            return successResponse($response, Constant::MESSAGE_FETCHED);
        } catch (Exception $e) {
            return errorResponse($e->getMessage(),$e->getCode());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CityRequest $request, City $city)
    {
        // TODO
        try {
            $data = $request->validated();
            $response = $this->repo->updateModel($city, $data);

            return successResponse($response, Constant::MESSAGE_UPDATED);
        } catch (Exception $e) {
            return errorResponse($e->getMessage(),$e->getCode());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(City $city)
    {
        try {
            $this->repo->deleteByModel($city);

            return successResponse(true, Constant::MESSAGE_DELETED);
        } catch (Exception $e) {
            return errorResponse($e->getMessage(),$e->getCode());
        }
    }
}
