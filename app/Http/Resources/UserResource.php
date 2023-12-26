<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
                'name' => $this->name,
                'email' => $this->email,
                'phone_number' => $this->phone_number,
                'profile_image' => new ImageResource($this->image),
                'total_reviews' => $this->whenNotNull($this->total_reviews),
                'average_rating' => $this->whenNotNull($this->average_rating),
                'review' => $this->whenNotNull($this->review),
            ];
    }
}
