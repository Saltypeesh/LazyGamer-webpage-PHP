<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ListingsResource extends JsonResource
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
                'title' => $this->title,
                'price' => $this->price,
                'tags' => $this->tags,
                'platforms' => $this->platform->platname,
                'banner' => $this->banner,
                'background' => $this->background,
                'description' => $this->description,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at                
            ],
            'relationships' => [
                'id' => (string)$this->user->id,
                'user_username' => $this->user->username,
                'user_email' => $this->user->email
            ]
        ];
    }
}
