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
        $totalReviews = $this->whenLoaded('sellerReview') ? $this->sellerReview->count() : 0;
        $averageRating = $this->whenLoaded('sellerReview') ? number_format($this->sellerReview->avg('rating'), 2) : 0;
        return [
                'id' => $this->id,
                'name' => $this->name,
                'email' => $this->email,
                'phone_number' => $this->phone_number,
                'profile_image' => new ImageResource($this->image),
                'total_reviews' => $totalReviews,
                'average_rating' => $averageRating,
                'review' => ReviewResource::collection($this->whenLoaded('sellerReview'))
            
            ];
    }
}
