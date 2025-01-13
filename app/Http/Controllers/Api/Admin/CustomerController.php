<?php

namespace App\Http\Controllers\Api\Admin;

use Exception;
use App\Models\Customer;
use App\Helpers\Constant;
use Illuminate\Http\Request;
use App\Http\Requests\CustomerRequest;
use App\Http\Controllers\BaseController;
use App\Repository\Contracts\CustomerRepositoryInterface;

class CustomerController extends BaseController
{
    public function __construct(
        public readonly CustomerRepositoryInterface $repo)
    {
        $this->middleware('permission:customer-read', ['only' => ['index','show']]);
        $this->middleware('permission:customer-create', ['only' => 'store']);
        $this->middleware('permission:customer-update', ['only' => 'update']);
        $this->middleware('permission:customer-delete', ['only' => 'destroy']);
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
    public function store(CustomerRequest $request)
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
    public function show(Customer $customer)
    {
        try {
            $response = $this->repo->showModel($customer);
            
            return successResponse($response, Constant::MESSAGE_FETCHED);
        } catch (Exception $e) {
            return errorResponse($e->getMessage(),$e->getCode());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CustomerRequest $request, Customer $customer)
    {
        // TODO
        try {
            $data = $request->validated();
            $response = $this->repo->updateModel($customer, $data);

            return successResponse($response, Constant::MESSAGE_UPDATED);
        } catch (Exception $e) {
            return errorResponse($e->getMessage(),$e->getCode());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        try {
            $this->repo->deleteByModel($customer);

            return successResponse(true, Constant::MESSAGE_DELETED);
        } catch (Exception $e) {
            return errorResponse($e->getMessage(),$e->getCode());
        }
    }
}
