<?php

namespace App\Http\Controllers\Api\Admin;

use Exception;
use App\Models\Currency;
use App\Helpers\Constant;
use Illuminate\Http\Request;
use App\Http\Requests\CurrencyRequest;
use App\Http\Controllers\BaseController;
use App\Repository\Contracts\CurrencyRepositoryInterface;

class CurrencyController extends BaseController
{
    public function __construct(
        public readonly CurrencyRepositoryInterface $repo)
    {
        if (!auth()->guard('admin')->check()) {
            $this->middleware('permission:currency-read', ['only' => ['index','show']]);
            $this->middleware('permission:currency-create', ['only' => 'store']);
            $this->middleware('permission:currency-update', ['only' => 'update']);
            $this->middleware('permission:currency-delete', ['only' => 'destroy']);
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
            $response = $this->repo->all(paginate: $paginate, perPage: $perPage);

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
            $response = $this->repo->showModel($city);
            
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