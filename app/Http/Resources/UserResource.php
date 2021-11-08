<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'id' => $this->id,
            'email' => $this->email,
            'name' => $this->name,
            'profile_photo_path' => $this->profile_photo_path,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'email_verified_at' => $this->email_verified_at,
            'profile_photo_url' => $this->profile_photo_url,
            'two_factor_enabled' => $this->two_factor_enabled,
            'roles' => [
                'isAdmin' => $this->hasRole('admin'),
                'isActive' => $this->hasAnyRole('admin', 'saler', 'appraiser', 'disburser'),
                'isAppraiser' => $this->hasAnyRole('admin', 'appraiser'),
                'isDisburser' => $this->hasAnyRole('admin', 'disburser'),
            ]
        ];
    }
}
