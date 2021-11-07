<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AreaJobResource extends JsonResource
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
            'name' => $this->name,
            'description' => $this->description,            
            'actions' => array(
                'crsf' => csrf_token(),
                'edit' => route('areas.edit', ['id' => $this->id]),
                'delete' => route('areas.delete', ['id' => $this->id])
            ),
        ];
    }
}
