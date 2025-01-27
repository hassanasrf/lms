<?php

namespace App\Repository\Eloquent;

use App\Models\Agent;
use Illuminate\Support\Arr;
use App\Http\Resources\AgentResource;
use Illuminate\Database\Eloquent\Model;
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

    public function createAgent(array $data): AgentResource
    {
        $agent = $this->create(Arr::except($data, ['tagging_point_ids']));    
        $agent->taggingPoints()->attach(@$data['tagging_point_ids']);

        return $this->resource::make($agent);
    }

    public function updateAgent(Model $model, array $data): bool
    {
        if (isset($data['tagging_point_ids'])) {
            $model->taggingPoints()->sync($data['tagging_point_ids']);
        }

        $model->update(Arr::except($data, ['tagging_point_ids']));
        return true;
    }

}
