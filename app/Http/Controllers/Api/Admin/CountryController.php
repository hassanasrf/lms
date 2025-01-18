<?php

namespace App\Http\Controllers\Api\Admin;

use Exception;
use App\Models\Country;
use App\Helpers\Constant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CountryRequest;
use App\Http\Controllers\BaseController;
use App\Repository\Contracts\CountryRepositoryInterface;

class CountryController extends BaseController
{
    public function __construct(
        public readonly CountryRepositoryInterface $repo)
    {
        if (!auth()->guard('admin')->check()) {
            $this->middleware('permission:country-read', ['only' => ['index','show']]);
            $this->middleware('permission:country-create', ['only' => 'store']);
            $this->middleware('permission:country-update', ['only' => 'update']);
            $this->middleware('permission:country-delete', ['only' => 'destroy']);
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
            $relations = ['cities'];
            
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
    public function store(CountryRequest $request)
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
    public function show(Country $country)
    {
        try {
            $relations = ['cities'];
            $response = $this->repo->showModel($country, $relations);
            
            return successResponse($response, Constant::MESSAGE_FETCHED);
        } catch (Exception $e) {
            return errorResponse($e->getMessage(),$e->getCode());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CountryRequest $request, Country $country)
    {
        // TODO
        try {
            $data = $request->validated();
            $response = $this->repo->updateModel($country, $data);

            return successResponse($response, Constant::MESSAGE_UPDATED);
        } catch (Exception $e) {
            return errorResponse($e->getMessage(),$e->getCode());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Country $country)
    {
        try {
            $this->repo->deleteByModel($country);

            return successResponse(true, Constant::MESSAGE_DELETED);
        } catch (Exception $e) {
            return errorResponse($e->getMessage(),$e->getCode());
        }
    }
}
