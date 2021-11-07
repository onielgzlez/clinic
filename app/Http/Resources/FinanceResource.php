<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FinanceResource extends JsonResource
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
            'type' => $this->type,
            'amount' => $this->amount,
            'pay_date' => $this->pay_date,
            'order' => $this->order,
            'organization' => $this->organization->name,           
            'user' => $this->user->fullName,           
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'actions' => array(
                'crsf' => csrf_token(),
                'view' => route('finances.show', ['id' => $this->id]),
                'edit' => route('finances.edit', ['id' => $this->id]),
                'delete' => route('finances.delete', ['id' => $this->id])
            ),
        ];
    }
}
