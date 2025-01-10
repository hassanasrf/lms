<?php

namespace App\Repository\Eloquent;

use App\Models\Agent;
use Illuminate\Database\Eloquent\Model;
use App\Http\Resources\AgentResource;
use App\Repository\Contracts\AgentRepositoryInterface;

class AgentRepository extends BaseRepository implements AgentRepositoryInterface
{
    /**
     * AgentRepository constructor.
     *
     * @param Agent $model
     */
    public function __construct(Agent $model)
    {
        $this->model = $model;
        $this->resource = AgentResource::class;
    }

}
