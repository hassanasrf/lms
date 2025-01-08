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
        // Initialize the base data array
        $data = [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
        ];

        // Check if the route contains the 'admin' prefix and add extra fields if not
        if ($this->isNotAdminRoute($request)) {
            $data = array_merge($data, $this->getNonAdminFields());
        }

        // Always include timestamps at the end
        $data['created_at'] = $this->created_at;
        $data['updated_at'] = $this->updated_at;

        return $data;
    }

    /**
     * Check if the current route is for an admin.
     *
     * @param  Request  $request
     * @return bool
     */
    private function isNotAdminRoute(Request $request): bool
    {
        return strpos($request->path(), 'admin') === false;
    }

    /**
     * Get fields that should be included for non-admin users.
     *
     * @return array
     */
    private function getNonAdminFields(): array
    {
        return [
            'company_id' => $this->company?->id,
            'company_name' => $this->company?->name,
            'role' => $this->role_name,
            'permission' => $this->permission,
        ];
    }
}
