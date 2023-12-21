<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'name' => $this->name,
            'condition' => $this->condition,
            'price' => $this->price,
            'description' => $this->description,
            'category' => $this->category,
            'product_image' => ImageResource::collection($this->whenLoaded('image'))
        ];
    }
}
