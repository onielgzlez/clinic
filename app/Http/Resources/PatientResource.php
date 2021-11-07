<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PatientResource extends JsonResource
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
            'organizations' => $this->nameClinics,
            'email' => $this->email,
            'document' => $this->document,
            'city' => $this->city ? $this->city->name : '',
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'actions' => array(
                'crsf' => csrf_token(),
                'edit' => route('patients.edit', ['id' => $this->id]),
                'delete' => route('patients.delete', ['id' => $this->id])
            ),
        ];
    }
}
