<?php

namespace App\Http\Controllers\Api\Admin;

use Exception;
use App\Helpers\Constant;
use App\Models\TaggingPoint;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Http\Requests\TaggingPointRequest;
use App\Repository\Contracts\TaggingPointRepositoryInterface;

class TaggingPointController extends BaseController
{
    public function __construct(
        public readonly TaggingPointRepositoryInterface $repo)
    {
        $this->middleware('permission:tagging-point-read', ['only' => ['index','show']]);
        $this->middleware('permission:tagging-point-create', ['only' => 'store']);
        $this->middleware('permission:tagging-point-update', ['only' => 'update']);
        $this->middleware('permission:tagging-point-delete', ['only' => 'destroy']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $paginate = $request->boolean('paginate', true);
            $perPage = (int) $request->get('perPage', 10);
            $relations = ['country','city'];
            $response = $this->repo->all(relations: $relations, paginate: $paginate, perPage: $perPage);

            return successResponse($response, Constant::MESSAGE_FETCHED, $paginate);
        } catch (Exception $e) {
            return errorResponse($e->getMessage(), $e->getCode());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaggingPointRequest $request)
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
    public function show(TaggingPoint $tagging_point)
    {
        try {
            $relations = ['country','city'];
            $response = $this->repo->showModel($tagging_point, $relations);
            
            return successResponse($response, Constant::MESSAGE_FETCHED);
        } catch (Exception $e) {
            return errorResponse($e->getMessage(),$e->getCode());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaggingPointRequest $request, TaggingPoint $tagging_point)
    {
        // TODO
        try {
            $data = $request->validated();
            $response = $this->repo->updateModel($tagging_point, $data);

            return successResponse($response, Constant::MESSAGE_UPDATED);
        } catch (Exception $e) {
            return errorResponse($e->getMessage(),$e->getCode());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TaggingPoint $tagging_point)
    {
        try {
            $this->repo->deleteByModel($tagging_point);

            return successResponse(true, Constant::MESSAGE_DELETED);
        } catch (Exception $e) {
            return errorResponse($e->getMessage(),$e->getCode());
        }
    }
}
