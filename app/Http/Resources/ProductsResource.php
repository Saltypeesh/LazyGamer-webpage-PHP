<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductsResource extends JsonResource
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
                'platforms' => $this->platforms,
                'banner' => $this->banner,
                'background' => $this->background,
                'description' => $this->description,              
            ]
        ];
    }
}
