<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class ImageResource extends JsonResource
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
            'user_id' => $this->whenNotNull($this->user_id),
            'product_id' => $this->whenNotNull($this->product_id),
            'context' => $this->context,
            'name_file_image' => Storage::url($this->name_file_image),
        ];
    }
}
