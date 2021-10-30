<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

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
            'name' => $this->fullName,
            'photo' => $this->avatar,
            'roles' => $this->nameRoles,
            'status' => $this->status,
            'email' => $this->email,
            'type' => $this->type,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'self' => Auth::user()->id == $this->id,
            'actions' => array(
                'crsf' => csrf_token(),
                'edit' => route('users.edit', ['id' => $this->id]),
                'delete' => route('users.delete', ['id' => $this->id])
            ),
        ];
    }
}
