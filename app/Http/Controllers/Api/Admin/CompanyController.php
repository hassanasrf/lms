<?php

namespace App\Http\Controllers\Api\Admin;

use Exception;
use App\Models\Company;
use App\Helpers\Constant;
use Illuminate\Http\Request;
use App\Http\Requests\CompanyRequest;
use App\Http\Controllers\BaseController;
use App\Repository\Contracts\CompanyRepositoryInterface;

class CompanyController extends BaseController
{
    public function __construct(
        public readonly CompanyRepositoryInterface $repo)
    {
        if (!auth()->guard('admin')->check()) {
            $this->middleware('permission:company-read', ['only' => ['index','show']]);
            $this->middleware('permission:company-create', ['only' => 'store']);
            $this->middleware('permission:company-update', ['only' => 'update']);
            $this->middleware('permission:company-delete', ['only' => 'destroy']);
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
    public function store(CompanyRequest $request)
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
    public function show(Company $company)
    {
        try {
            $response = $this->repo->showModel($company);
            
            return successResponse($response, Constant::MESSAGE_FETCHED);
        } catch (Exception $e) {
            return errorResponse($e->getMessage(),$e->getCode());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CompanyRequest $request, Company $company)
    {
        // TODO
        try {
            $data = $request->validated();
            $response = $this->repo->updateModel($company, $data);

            return successResponse($response, Constant::MESSAGE_UPDATED);
        } catch (Exception $e) {
            return errorResponse($e->getMessage(),$e->getCode());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        try {
            $this->repo->deleteByModel($company);

            return successResponse(true, Constant::MESSAGE_DELETED);
        } catch (Exception $e) {
            return errorResponse($e->getMessage(),$e->getCode());
        }
    }
}
