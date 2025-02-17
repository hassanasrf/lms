<?php

namespace App\Http\Controllers\Api\Admin;

use Exception;
use App\Models\ShippingLine;
use App\Helpers\Constant;
use Illuminate\Http\Request;
use App\Http\Requests\ShippingLineRequest;
use App\Http\Controllers\BaseController;
use App\Repository\Contracts\ShippingLineRepositoryInterface;

class ShippingLineController extends BaseController
{
    public function __construct(
        public readonly ShippingLineRepositoryInterface $repo)
    {
        $this->middleware('permission:shipping-read', ['only' => ['index','show']]);
        $this->middleware('permission:shipping-create', ['only' => 'store']);
        $this->middleware('permission:shipping-update', ['only' => 'update']);
        $this->middleware('permission:shipping-delete', ['only' => 'destroy']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $paginate = $request->boolean('paginate', true);
            $perPage = (int) $request->get('perPage', 10);
            $relations = ['agents','banks'];
            $response = $this->repo->all(relations: $relations, paginate: $paginate, perPage: $perPage);

            return successResponse($response, Constant::MESSAGE_FETCHED, $paginate);
        } catch (Exception $e) {
            return errorResponse($e->getMessage(), $e->getCode());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ShippingLineRequest $request)
    {
        try {
            $response = $this->repo->createShippingLine($request->validated());

            return successResponse($response, Constant::MESSAGE_CREATED);
        } catch (Exception $e) {
            return errorResponse($e->getMessage(),$e->getCode());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(ShippingLine $shipping_line)
    {
        try {
            $relations = ['agents','banks'];
            $response = $this->repo->showModel($shipping_line, $relations);
            
            return successResponse($response, Constant::MESSAGE_FETCHED);
        } catch (Exception $e) {
            return errorResponse($e->getMessage(),$e->getCode());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ShippingLineRequest $request, ShippingLine $shipping_line)
    {
        try {
            $data = $request->validated();
            $response = $this->repo->updateShippingLine($shipping_line, $data);

            return successResponse($response, Constant::MESSAGE_UPDATED);
        } catch (Exception $e) {
            return errorResponse($e->getMessage(),$e->getCode());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ShippingLine $shipping_line)
    {
        try {
            $this->repo->deleteByModel($shipping_line);

            return successResponse(true, Constant::MESSAGE_DELETED);
        } catch (Exception $e) {
            return errorResponse($e->getMessage(),$e->getCode());
        }
    }
}
