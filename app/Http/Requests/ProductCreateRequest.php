<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProductCreateRequest extends FormRequest
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
            'name' => 'required|max:100',
            'condition' => 'required',
            'price' => 'required',
            'description' => 'nullable',
            'category_id' => 'required',
            'product_image' => 'nullable'
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
