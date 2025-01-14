<?php

namespace App\Http\Controllers\Api\Admin;

use Exception;
use App\Models\Bank;
use App\Helpers\Constant;
use Illuminate\Http\Request;
use App\Http\Requests\BankRequest;
use App\Http\Controllers\BaseController;
use App\Repository\Contracts\BankRepositoryInterface;

class BankController extends BaseController
{
    public function __construct(
        public readonly BankRepositoryInterface $repo)
    {
        $this->middleware('permission:bank-read', ['only' => ['index','show']]);
        $this->middleware('permission:bank-create', ['only' => 'store']);
        $this->middleware('permission:bank-update', ['only' => 'update']);
        $this->middleware('permission:bank-delete', ['only' => 'destroy']);
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
    public function store(BankRequest $request)
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
    public function show(Bank $bank)
    {
        try {
            $response = $this->repo->showModel($bank);
            
            return successResponse($response, Constant::MESSAGE_FETCHED);
        } catch (Exception $e) {
            return errorResponse($e->getMessage(),$e->getCode());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BankRequest $request, Bank $bank)
    {
        try {
            $data = $request->validated();
            $response = $this->repo->updateModel($bank, $data);

            return successResponse($response, Constant::MESSAGE_UPDATED);
        } catch (Exception $e) {
            return errorResponse($e->getMessage(),$e->getCode());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bank $bank)
    {
        try {
            $this->repo->deleteByModel($bank);

            return successResponse(true, Constant::MESSAGE_DELETED);
        } catch (Exception $e) {
            return errorResponse($e->getMessage(),$e->getCode());
        }
    }
}
