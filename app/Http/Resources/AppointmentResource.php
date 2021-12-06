<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AppointmentResource extends JsonResource
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
            'init' => $this->init,
            'end' => $this->end,
            'observation' => $this->observation,
            'status' => $this->state,
            'color' => $this->color,
            'organization' => $this->organization->name,
            'user' => $this->user->fullName,
            'patient' => ['name' => $this->patient->fullName, 'photo' => $this->patient->avatar, 'email' => $this->patient->email],
            'specialty' => $this->area_job->name,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'actions' => array(
                'crsf' => csrf_token(),
                'view' => route('appointments.show', ['id' => $this->id]),
                'edit' => route('appointments.edit', ['id' => $this->id]),
                'delete' => route('appointments.delete', ['id' => $this->id])
            ),
        ];
    }
}
