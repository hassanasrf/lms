<?php

namespace App\Http\Controllers\Api\Admin;

use Exception;
use App\Models\Agent;
use App\Helpers\Constant;
use Illuminate\Http\Request;
use App\Http\Requests\AgentRequest;
use App\Http\Controllers\BaseController;
use App\Repository\Contracts\AgentRepositoryInterface;

class AgentController extends BaseController
{
    public function __construct(
        public readonly AgentRepositoryInterface $repo)
    {
        $this->middleware('permission:agent-read', ['only' => ['index','show']]);
        $this->middleware('permission:agent-create', ['only' => 'store']);
        $this->middleware('permission:agent-update', ['only' => 'update']);
        $this->middleware('permission:agent-delete', ['only' => 'destroy']);
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
    public function store(AgentRequest $request)
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
    public function show(Agent $agent)
    {
        try {
            $response = $this->repo->showModel($agent);
            
            return successResponse($response, Constant::MESSAGE_FETCHED);
        } catch (Exception $e) {
            return errorResponse($e->getMessage(),$e->getCode());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AgentRequest $request, Agent $agent)
    {
        try {
            $data = $request->validated();
            $response = $this->repo->updateModel($agent, $data);

            return successResponse($response, Constant::MESSAGE_UPDATED);
        } catch (Exception $e) {
            return errorResponse($e->getMessage(),$e->getCode());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Agent $agent)
    {
        try {
            $this->repo->deleteByModel($agent);

            return successResponse(true, Constant::MESSAGE_DELETED);
        } catch (Exception $e) {
            return errorResponse($e->getMessage(),$e->getCode());
        }
    }
}
