<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ChatRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => 'required',
            'seller_id' => 'required',
            'offer_id' => 'required',
            'sender_type' => 'required',
            'chat' => 'required'
        ];
    }
    protected function failedValidation(Validator $validator) {
        throw new HttpResponseException(response([
            'status' => false,
            'message' => 'Validation Error',
            'errors' => $validator->getMessageBag()
        ],403));
    }
}
