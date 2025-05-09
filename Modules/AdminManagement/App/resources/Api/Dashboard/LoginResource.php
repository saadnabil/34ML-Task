<?php

namespace Modules\AdminManagement\App\resources\Api\Dashboard;

use Illuminate\Http\Resources\Json\JsonResource;

class LoginResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     */
    public function toArray($request): array
    {
        return[
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'image' => $this->image_path,
            'access_token' => $this->access_token,
        ];
    }
}
