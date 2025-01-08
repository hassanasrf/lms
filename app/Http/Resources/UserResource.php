<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'company_id' => $this->company?->id,
            'company_name' => $this->company?->name,
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role_name,
            'permission' => $this->permission,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
