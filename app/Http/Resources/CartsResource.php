<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CartsResource extends JsonResource
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
            'id' => (string)$this->id,
            'attributes' => [
                'title' => $this->listing->title,
                'price' => $this->listing->price,
                'amount' => $this->amount
            ],
            'relationships' => [
                'user_id' => (string)$this->user->id,
                'product_id' => (string)$this->listing->id
            ]
        ];
    }
}
