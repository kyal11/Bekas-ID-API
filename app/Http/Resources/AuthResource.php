<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthResource extends JsonResource
{
    protected $customMessage;

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    /**
     * Set custom message for the resource.
     *
     * @param string $message
     * @return $this
     */
    public function __construct($resource, $customMessage = null)
    {
        parent::__construct($resource);
        $this->customMessage = $customMessage;
    }
    public function toArray(Request $request): array
    {
        return [
            'status' => true,
            'message' => $this->customMessage,
            'data' => [
                'id' => $this->id,
                'name' => $this->name,
                'email' => $this->email,
                'token' => $this->whenNotNull($this->token)]
        ];
    }
}
