<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class UsersResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            User::ID         => $this->id,
            User::NAME       => $this->name,
            User::EMAIL      => $this->email,
            User::CREATED_AT => $this->created_at,
            User::UPDATED_AT => $this->updated_at,
        ];
    }
}
